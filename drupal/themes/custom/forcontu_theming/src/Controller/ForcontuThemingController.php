<?php

/**
 * @file
 * Contains \Drupal\forcontu_theming\Controller\ForcontuThemingController.
 */

namespace Drupal\forcontu_theming\Controller;

use Drupal\Core\Controller\ControllerBase;

class ForcontuThemingController extends ControllerBase {
  public function render() {
    $header = ['Column 1', 'Column 2', 'Column 3'];
    $rows[] = ['A', 'B', 'C'];
    $rows[] = ['D', 'E', 'F'];

    $list = ['Item 1', 'Item 2', 'Item 3'];
    
    $build = [
      '#attached' => [
        'library' => [
          'forcontu_theming/forcontu_theming.css',
        ],
      ],
      'container' => [
        '#prefix' => '<div id="container">',
        '#suffix' => '</div>',
        'markup' => [
          '#markup' => '<p>' . $this->t('Lorem ipsum dolor sit amet,
          consectetur adipiscing elit.') . '</p>',
        ],
        'table' => [
          '#type' => 'table',
          '#header' => $header,
          '#rows' => $rows,
        ],
        'list' => [
          '#theme' => 'item_list',
          '#title' => $this->t('List of items'),
          '#list_type' => 'ol',
          '#items' => $list,
        ],
      ],
    ];

    return $build;
  }
}