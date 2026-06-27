<?php

/**
 * @file
 * Contains \Drupal\forcontu_database\Controller\ForcontuDatabaseController.
 */

namespace Drupal\forcontu_database\Controller;

use Drupal\Core\Controller\ControllerBase;

class ForcontuDatabaseController extends ControllerBase {
  public function comment() {
    return [
      '#markup' => '<p>' . $this->t('This is a comment page') . '</p>',
    ];
  }
}