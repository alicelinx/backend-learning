<?php

namespace Drupal\forcontu_theming\Element;

use Drupal\Core\Render\Element\RenderElement;

/**
 * Provides a render element to display a Dimensions item.
 * 
 * @RenderElement("forcontu_theming_dimensions")
 */
class ForcontuThemingDimensions extends RenderElement {

  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    $class = get_class($this);
    return [
      '#pre_render' => [
        [$class, 'preRenderForcontuThemingDimensions'],
      ],
      '#length' => NULL,
      '#width' => NULL,
      '#height' => NULL,
      '#unit' => 'cm.',
      '#theme' => 'forcontu_theming_dimensions',
    ];
  }

  /**
   * Element pre render callback.
   */
  public static function preRenderForcontuThemingDimensions($element) {
    return $element;
  }
}
