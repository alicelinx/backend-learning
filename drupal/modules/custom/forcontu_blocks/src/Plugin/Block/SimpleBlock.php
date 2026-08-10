<?php

namespace Drupal\forcontu_blocks\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a Simple example block.
 * 
 * @Block(
 *    id = "forcontu_blocks_simple_block",
 *    admin_label = @Translation("Forcontu Simple Block")
 * )
 */
class SimpleBlock extends BlockBase {
  public function build() {
    return [
      '#markup' => '<span>' . $this->t('Simple block') . '</span>'
    ];
  }
}