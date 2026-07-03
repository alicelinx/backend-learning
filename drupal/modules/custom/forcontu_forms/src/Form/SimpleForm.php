<?php

namespace Drupal\forcontu_forms\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Database\Connection;
use Drupal\Core\Session\AccountInterface;
use Egulias\EmailValidator\EmailValidator;

/**
 * Implements the Simple form controller.
 */
class SimpleForm extends FormBase {
  protected $database;
  protected $currentUser;
  protected $emailValidator;

  public function __construct(Connection $database, AccountInterface $current_user, EmailValidator $email_validator) {
    $this->database = $database;
    $this->currentUser = $current_user;
    $this->emailValidator = $email_validator;
  }

  public static function create(ContainerInterface $container) {
    return new static (
      $container->get('database'),
      $container->get('current_user'),
      $container->get('email.validator')
    );
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#description' => $this->t('The title must be between 5 and 30 characters long and start with a capital letter.'),
      '#required' => TRUE,
    ];

    $form['username'] = [
      '#type' => 'textfield',
      '#title' => $this->t('User name'),
      '#description' => $this->t('Your user name.'),
      '#default_value' => $this->currentUser->getAccountName(),
      '#required' => TRUE,
    ];

    $form['user_email'] = [
      '#type' => 'email',
      '#title' => $this->t('User email'),
      '#description' => $this->t('Your email.'),
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

  public function validateForm(array &$form, FormStateInterface $form_state) {
    $title = $form_state->getValue('title');
    if (strlen($title) < 5 || strlen($title) > 30 || !ctype_upper($title[0])) {
      $form_state->setErrorByName('title', $this->t('The title must be between 5 and 30 characters long and start with a capital letter.'));
    }

    $email = $form_state->getValue('user_email');
    if (!$this->emailValidator->isValid($email)) {
      $form_state->setErrorByName('user_email', $this->t('@email is not a valid email address.', ['@email' => $email]));
    }

    
    if ($this->currentUser->isAuthenticated()) {
      $username = $form_state->getValue('username');
      $currentUsername = $this->currentUser->getAccountName();

      if ($username !== $currentUsername) {
        $form_state->setErrorByName('username', $this->t('User name cannot be changed.'));
      }

      $uid = $this->currentUser->id();

      $exists = $this->database
        ->select('forcontu_forms_simple', 'f')
        ->fields('f', ['uid'])
        ->condition('uid', $uid)
        ->execute()
        ->fetchField();
      
      if ($exists) {
        $form_state->setErrorByName('username', $this->t('This user has already submitted the form.'));
      }
    }
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->database->insert('forcontu_forms_simple')
      ->fields([
        'title' => $form_state->getValue('title'),
        'uid' => $this->currentUser->id(),
        'username' => $form_state->getValue('username'),
        'email' => $form_state->getValue('user_email'),
        'ip' => \Drupal::request()->getClientIp(),
        'timestamp' => \Drupal::time()->getRequestTime(),
      ])
      ->execute();
    
    $this->messenger()->addMessage($this->t('The form has been submitted successfully by @username',
      [ 
        '@username' => $form_state->getValue('username'),
      ])
    );
    $this->logger('forcontu_forms')->notice('New Simple Form entry from user @username (uid: @uid) inserted: @title',
      [
        '@username' => $form_state->getValue('username'),
        '@uid' => $this->currentUser->id(),
        '@title' => $form_state->getValue('title'),
      ]
    );
    $form_state->setRedirect('forcontu_pages.simple');
  }
}