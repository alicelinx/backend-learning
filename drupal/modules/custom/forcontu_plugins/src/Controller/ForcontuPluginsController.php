<?php

/**
 * @file
 * Contains \Drupal\forcontu_plugins\Controller\ForcontuPluginsController.
 */

namespace Drupal\forcontu_plugins\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\forcontu_plugins\FipsumPluginManager;
use Drupal\forcontu_plugins\ForcontuCoursesInterface;

class ForcontuPluginsController extends ControllerBase {
  protected $fipsum;
  protected $forcontuCourses;

  public function __construct(FipsumPluginManager $fipsum, ForcontuCoursesInterface $forcontu_courses) {
    $this->fipsum = $fipsum;
    $this->forcontuCourses = $forcontu_courses;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('plugin.manager.fipsum'),
      $container->get('forcontu.courses')
    );
  }

  public function fipsum() {
    $lorem_ipsum = $this->fipsum->createInstance('lorem_ipsum');

    $build['fipsum_lorem_ipsum_title'] = [
      '#markup' => '<h2>' . $lorem_ipsum->description() . '</h2>',
    ];

    $build['fipsum_lorem_ipsum_text'] = [
      '#markup' => '<p>' . $lorem_ipsum->generate(600) . '</p>',
    ];

    $forcontu_ipsum = $this->fipsum->createInstance('forcontu_ipsum');

    $build['fipsum_forcontu_ipsum_title'] = [
      '#markup' => '<h2>' . $forcontu_ipsum->description() . '</h2>',
    ];

    $build['fipsum_forcontu_ipsum_text'] = [
      '#markup' => '<p>' . $forcontu_ipsum->generate(600) . '</p>',
    ];

    $pony_ipsum = $this->fipsum->createInstance('pony_ipsum');

    $build['fipsum_pony_ipsum_title'] = [
      '#markup' => '<h2>' . $pony_ipsum->description() . '</h2>',
    ];

    $build['fipsum_pony_ipsum_text'] = [
      '#markup' => '<p>' . $pony_ipsum->generate() . '</p>',
    ];

    return $build;
  }

  public function courses() {
    $list = $this->forcontuCourses->getCourses();

    $header = [$this->t('Title'), $this->t('Tutor'),
              $this->t('Duration (months)'), $this->t('Hours')];

    $build['forcontu_plugins_table'] = [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $list,
    ];

    return $build;
  }
}