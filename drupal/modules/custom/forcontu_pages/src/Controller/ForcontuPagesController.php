<?php

/**
 * @file
 * Contains \Drupal\forcontu_pages\Controller\ForcontuPagesController.
 */

namespace Drupal\forcontu_pages\Controller;

use Drupal\Core\Controller\ControllerBase;

class ForcontuPagesController extends ControllerBase {
  public function simple() {
    return [
      '#markup' => '<p>' . $this->t('This is a simple page (with no arguments)') . '</p>',
    ];
  }
}