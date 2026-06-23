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

    // newsletter
    $newsletter_config = \Drupal::config('forcontu_config.settings');
    $newsletter_subject = $newsletter_config->get('newsletter.subject');
    $newsletter_default_from_email = $newsletter_config->get('newsletter.default_from_email');
    $newsletter_active = $newsletter_config->get('newsletter.active');
    $newsletter_periodicity = $newsletter_config->get('newsletter.periodicity');
    $newsletter_news_number = $newsletter_config->get('newsletter.news_number');
    $newsletter_country = $newsletter_config->get('newsletter.country');

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
        <br>
        <h4>Newsletter config</h4>
        <p>Subject: ' . $newsletter_subject . '</p>
        <p>Default from email: ' . $newsletter_default_from_email . '</p>
        <p>Active: ' . ($newsletter_active ? 'Yes' : 'No') . '</p>
        <p>Periodicity: ' . $newsletter_periodicity . '</p>
        <p>News number: ' . $newsletter_news_number . '</p>
        <p>Country: ' . $newsletter_country . '</p>
        
      ',
    ];
  }
}