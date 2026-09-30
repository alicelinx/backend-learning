<?php

namespace Drupal\forcontu_plugins\Plugin\Fipsum;

use Drupal\forcontu_plugins\FipsumBase;

/**
 * Provides a PonyIpsum text.
 * 
 * @Fipsum(
 *  id = "pony_ipsum",
 *  description = @Translation("Pony Ipsum text")
 * )
 */
class PonyIpsum extends FipsumBase {

  public function generate($length = 100) {
    $json = file_get_contents('https://ponyipsum.com/api/?type=all-pony&paras=1&start-with-lorem=1');
    $parsedData = json_decode($json);

    return $parsedData[0];
  }
}