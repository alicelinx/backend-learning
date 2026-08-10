<?php

namespace Drupal\forcontu_blocks\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides the HighlightedContent block.
 * 
 * @Block(
 *    id = "forcontu_blocks_highlighted_content_block",
 *    admin_label = @Translation("Highlighted Content")
 * )
 */
class HighlightedContentBlock extends BlockBase {
  public function build() {
    return [
      '#markup' => '<span>' . $this->t('Highlighted') . '</span>'
    ];
  }

  public function defaultConfiguration() {
    return [
      'block_message' => 'List of highlighted nodes',
      'node_number' => 5,
    ];
  }

  public function blockForm($form, FormStateInterface $form_state) {
    $form['forcontu_blocks_block_message'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Display message'),
      '#default_value' => $this->configuration['block_message'],
    ];

    $range = range(1, 10);
    $form['forcontu_blocks_node_number'] = [
      '#type' => 'select',
      '#title' => $this->t('Number of nodes'),
      '#default_value' => $this->configuration['node_number'],
      '#options' => array_combine($range, $range),
    ];
    return $form;
  }

  public function blockValidate($form, FormStateInterface $form_state) {
    if (strlen($form_state->getValue('forcontu_blocks_block_message')) < 10) {
      $this->t('The text must be at least 10 characters long');
    }
  }

  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['block_message'] =
      $form_state->getValue('forcontu_blocks_block_message');
    $this->configuration['node_number'] =
      $form_state->getValue('forcontu_blocks_node_number');
  }
}