<?php

namespace Drupal\forcontu_forms\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Database\Connection;
use Drupal\Core\Session\AccountInterface;

/**
 * Implements the Simple form controller.
 */
class SimpleForm extends FormBase {
  protected $database;
  protected $currentUser;

  public function __construct(Connection $database, AccountInterface $current_user) {
    $this->database = $database;
    $this->currentUser = $current_user;
  }

  public static function create(ContainerInterface $container) {
    return new static (
      $container->get('database'),
      $container->get('current_user')
    );
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#description' => $this->t('The title must be at least 5 characters long.'),
      '#required' => TRUE,
    ];

    $form['Username'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Username'),
      '#description' => $this->t('Your username'),
      '#default_value' => $this->currentUser->getAccountName(),
      '#required' => TRUE,
    ];

    $form['Email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#description' => $this->t('Your email'),
      '#default_value' => $this->currentUser->getEmail(),
      '#required' => TRUE,
    ];
  
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  public function getFormId() {
    return 'forcontu_forms_simple_form';
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    
  }

}