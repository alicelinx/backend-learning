<?php

/**
 * @file
 * Contains \Drupal\forcontu_cat\Controller\ForcontuCatController.
 */

namespace Drupal\forcontu_cat\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;


class ForcontuCatController extends ControllerBase {
  public function messages() {
    $config = $this->config('forcontu_cat.settings');
    $num_items = $config->get('num_items');
    
    $results = \Drupal::database()
      ->select('forcontu_cat_messages', 'f')
      ->fields('f')
      ->orderBy('nid', 'DESC')
      ->range(0, $num_items)
      ->execute();

    $form['messages'] = [
      '#type' => 'table',
      '#header' => [
        $this->t('Node ID'),
        $this->t('Title'),
        $this->t('Activated'),
        $this->t('Message'),
        $this->t('Operations'),
      ],
    ];

    foreach ($results as $result) {
      $node = \Drupal\node\Entity\Node::load($result->nid);
      
      $edit_url = Url::fromRoute('entity.node.edit_form', ['node' => $result->nid]);      
      $delete_url = Url::fromRoute('forcontu_cat.delete', ['node' => $result->nid]);

      $rows[] = [
        $result->nid,
        $node->getTitle(),
        ($result->checked == 0) ? "No" : "Yes",
        $result->message,
        [
          'data' => [
            '#type' => 'operations',
            '#links' => [
              'edit' => [
                'title' => t('Edit'),
                'url' => $edit_url,
              ],
              'delete' => [
                'title' => t('Delete'),
                'url' => $delete_url,
              ],
            ],
          ],
        ]
      ];

    }
    $form['messages']['#rows'] = $rows;

    return $form;
  }
}