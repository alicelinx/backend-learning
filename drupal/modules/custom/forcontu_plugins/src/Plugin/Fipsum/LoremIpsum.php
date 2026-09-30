<?php

namespace Drupal\forcontu_plugins\Plugin\Fipsum;

use Drupal\forcontu_plugins\FipsumBase;

/**
 * Provides a LoremIpsum text.
 * 
 * @Fipsum(
 *  id = "lorem_ipsum",
 *  description = @Translation("Lorem Ipsum text")
 * )
 */
class LoremIpsum extends FipsumBase {

  public function generate($length = 100) {
    $text = file_get_contents('https://lipsum.pro/api?type=characters&count=' . (int) $length . '&format=plain');
    
    return substr($text, 0, (int) $length) . '.';
  }
}