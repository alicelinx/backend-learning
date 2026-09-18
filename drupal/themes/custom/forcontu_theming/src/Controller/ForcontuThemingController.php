<?php

/**
 * @file
 * Contains \Drupal\forcontu_theming\Controller\ForcontuThemingController.
 */

namespace Drupal\forcontu_theming\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;

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

  public function nodes() {
    $header = [
      $this->t('Title'),
      $this->t('Type'),
      $this->t('Operations'),
    ];
    $rows = [];
    $nodes = Node::loadMultiple();

    foreach ($nodes as $node) {
      $operations = [
        '#type' => 'dropbutton',
        '#links' => [
          'view' => [
            'title' => $this->t('View'),
            'url' => $node->toUrl(),
          ],
          'edit' => [
            'title' => $this->t('Edit'),
            'url' => $node->toUrl('edit-form'),
          ],
          'delete' => [
            'title' => $this->t('Delete'),
            'url' => $node->toUrl('delete-form'),
          ],
        ],
      ];

      $rows[] = [
        'title' => $node->label(),
        'type' => $node->bundle(),
        'operations' => [
          'data' => $operations,
        ],
      ];
    }

    $build['nodes_table'] = [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    ];

    $build['recent_content'] = [
      '#type' => 'view',
      '#name' => 'content_recent',
    ];

    return $build;
  }
}