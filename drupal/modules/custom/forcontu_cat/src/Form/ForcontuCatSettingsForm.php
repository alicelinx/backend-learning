<?php

namespace Drupal\forcontu_cat\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class ForcontuCatSettingsForm extends ConfigFormBase {
  public function getFormId() {
    return 'forcontu.cat.settings';
  }

  public function getEditableConfigNames() {
    return [
      'forcontu_cat.settings'
    ];
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('forcontu_cat.settings');
    
    $types = node_type_get_names();
  
    $form['forcontu_cat_allowed_types'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Content types allowed'),
      '#default_value' => $config->get('allowed_types'),
      '#options' => $types,
      '#description' => $this->t('Select content types'),
    ];
  
    $form['forcontu_cat_message'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Message'),
      '#required' => TRUE,
      '#maxlength' => 100,
      '#description' => $this->t('Must have between 50 and 100 characters.'),
      '#default_value' => $config->get('message'),
      ];
  
    $form['forcontu_cat_num_items'] = [
      '#type' => 'select',
      '#title' => $this->t('Number of items'),
      '#options' => [
        1 => 1,
        2 => 2,
        3 => 3,
        4 => 4,
        5 => 5,
        10 => 10,
        20 => 20,
      ],
      '#description' => $this->t('Number of elements to show.'),
      '#default_value' => $config->get('num_items'),
    ];

    return parent::buildForm($form, $form_state);
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    $message = trim($form_state->getValue('forcontu_cat_message'));
    if (mb_strlen($message) < 50 || mb_strlen($message) > 100) {
      $form_state->setErrorByName(
        'forcontu_cat_message',
        $this->t('The message should be between 50 and 100 characters.')
      );
    }
    
    parent::validateForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $allowed_types = array_filter($form_state->getValue('forcontu_cat_allowed_types'));
    sort($allowed_types);

    $this->config('forcontu_cat.settings')
      ->set('allowed_types', $allowed_types)
      ->set('message', $form_state->getValue('forcontu_cat_message'))
      ->set('num_items', $form_state->getValue('forcontu_cat_num_items'))
      ->save();
    
    parent::submitForm($form, $form_state);
  }
}