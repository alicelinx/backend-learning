<?php

/**
 * @file
 * Contains \Drupal\forcontu_database\Controller\ForcontuDatabaseController.
 */

namespace Drupal\forcontu_database\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Database\Connection;
use Drupal\Core\Session\AccountInterface;

class ForcontuDatabaseController extends ControllerBase {
  protected $database;
  protected $currentUser;
  public function __construct(Connection $database, AccountInterface $current_user) {
    $this->database = $database;
    $this->currentUser = $current_user;
  }
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database'),
      $container->get('current_user')
    );
  }

  public function pageCount() {
    $route = \Drupal::service('path.current')->getPath();
    $uid = $this->currentUser->id();
    $results = $this->database->select('forcontu_database_counter', 'fdc')
      ->fields('fdc', ['user_count'])
      ->condition('route', $route)
      ->condition('uid', $uid)
      ->execute()
      ->fetchAssoc();
    
    if (!$results) {
      $count = 1;

      $this->database->insert('forcontu_database_counter')
        ->fields([
          'route' => $route,
          'uid' => $uid,
          'user_count' => $count,
          'lastcount' => time(),
        ])
        ->execute();

    } else {
      $count = $results['user_count'] + 1;

      $this->database->update('forcontu_database_counter')
        ->fields([
          'user_count' => $count,
          'lastcount' => time(),
        ])
        ->condition('route', $route)
        ->condition('uid', $uid)
        ->execute();
    }

    \Drupal::messenger()->addMessage(
        $this->t('Page visited for @count time(s).', ['@count' => $count])
      );
  }

  public function comment() {

    $query = $this->database->select('comment_field_data', 'cfd')
      ->fields('cfd', ['cid', 'entity_id', 'subject','uid']);

    $query->join('comment', 'c', 'cfd.cid = c.cid');
    $query->fields('c', ['uuid', 'extra']);

    $query->orderBy('cfd.cid', 'DESC');

    dpq($query);

    $result = $query->execute();


    $rows = [];

    foreach ($result as $record) {
      $rows[] = [
        $record->cid,
        $record->entity_id,
        $record->subject,
        $record->uid,
        $record->uuid,
        $record->extra,
      ];
    }

    $header = ['CID', 'Entity ID', 'Subject', 'UID', 'UUID', 'Extra'];

    $build['forcontu_comment_table'] = [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    ];

    $this->pageCount();
    return $build;
  }

}