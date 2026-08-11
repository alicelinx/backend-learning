<?php

namespace Drupal\forcontu_blocks\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Database\Connection;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Routing\RouteMatchInterface;

class NodeVotingForm extends FormBase {
  protected $database;
  protected $currentUser;
  protected $currentRouteMatch;

  public function __construct(Connection $database,
                              AccountInterface $current_user,
                              RouteMatchInterface $current_route_match) {
    $this->database = $database;
    $this->currentUser = $current_user;
    $this->currentRouteMatch = $current_route_match;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database'),
      $container->get('current_user'),
      $container->get('current_route_match')
    );
  }

  public function getFormId() {
    return 'forcontu_blocks_node_voting_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $node_vote = NULL;
    $node = $this->currentRouteMatch->getParameter('node');

    $nid = $node ? $node->id() : NULL;

    if($nid && $this->currentUser->isAuthenticated()) {
      $node_vote = $this->database->select('forcontu_node_votes', 'f')
        ->fields('f', ['vote'])
        ->condition('f.nid', $nid)
        ->condition('f.uid', $this->currentUser->id())
        ->execute()
        ->fetchField();
    }

    // Calculate the voting average
    $voting_average = NULL;
    $query = $this->database->select('forcontu_node_votes', 'f');
    $query->addExpression('AVG(vote)', 'mean_vote');
    $query->condition('f.nid', $nid);

    $voting_average = $query->execute()->fetchField();

    if($voting_average) {
      $form['node_vote_mean'] = [
        '#type' => 'item',
        '#markup' => $this->t('Average vote: @vote', ['@vote' => number_format($voting_average, 1)])
      ];
    }

    
    $form['node_vote'] = [
      '#type' => 'radios',
      '#title' => $this->t('Vote this node'),
      '#options' => [ 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5],
      '#description' => $this->t('How useful did you find this content?'),
      '#required' => TRUE,
      '#default_value' => $node_vote,
    ];
    $form['nid'] = [
      '#type' => 'value',
      '#value' => $nid,
    ];
    $form['uid'] = [
      '#type' => 'value',
      '#value' => $this->currentUser->id(),
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Vote'),
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $nid = $form_state->getValue('nid');
    $uid = $form_state->getValue('uid');
    $node_vote = $form_state->getValue('node_vote');

    $upsert = $this->database->upsert('forcontu_node_votes')
      ->key('nid')
      ->fields(['nid', 'uid', 'vote'])
      ->values([
        'nid' => $nid,
        'uid' => $uid,
        'vote' => $node_vote,
      ])
      ->execute();
    
    $this->messenger()->addMessage($this->t('Your vote on this node has been registered.'));
  }

}