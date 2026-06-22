<?php
/**
 * @file
 * Contains \Drupal\forcontu_config\Controller\ForcontuConfigController.
 */

namespace Drupal\forcontu_config\Controller;

use Drupal\Core\Controller\ControllerBase;

class ForcontuConfigController extends ControllerBase {
  public function index() {
    // State variable
    $cron_duration = \Drupal::state()->get('forcontu_config.cron_duration');

    // config
    $site_config = \Drupal::config('system.site');
    $site_name = $site_config->get('name');
    $site_email = $site_config->get('mail');

    $country_config = \Drupal::config('system.date');
    $country = $country_config->get('country.default');

    // performance
    $performance_config = \Drupal::config('system.performance');
    $css = $performance_config->get('css.preprocess');
    $js = $performance_config->get('js.preprocess');

    return [
      '#markup' => '
        <p>Site name: ' . $site_name . '</p>
        <p>Site email: ' . $site_email . '</p>
        <p>Default country: ' . $country . '</p>
        <br>
        <p>Cron duration: ' . $cron_duration . '</p>
        <br>
        <p>CSS aggregation: ' . ($css ? 'Enabled' : 'Disabled') . '</p>
        <p>JS aggregation: ' . ($js ? 'Enabled' : 'Disabled') . '</p>
      ',
    ];
  }
}