<?php

namespace Drupal\forcontu_forms\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements the Resume form controller.
 */
class ResumeForm extends FormBase {

  public function getFormId() {
    return 'forcontu_forms_resume_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['resume'] = [
      '#type' => 'vertical_tabs',
    ];

    // Tab 1: personal data
    $form['personal_data'] = [
      '#type' => 'details',
      '#title' => $this->t('Personal data'),
      '#group' => 'resume'
    ];

    $form['personal_data']['personal_info'] = [
      '#type' => 'details',
      '#title' => $this->t('Personal information'),
      '#open' => TRUE,
    ];

    $form['personal_data']['personal_info']['first_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First name'),
      '#required' => TRUE,
    ];

    $form['personal_data']['personal_info']['surname'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Surname'),
      '#required' => TRUE,
    ];

    $form['personal_data']['personal_info']['birth_date'] = [
      '#type' => 'date',
      '#title' => $this->t('Date of birth'),
      '#required' => TRUE,
    ];

    $form['personal_data']['personal_info']['country'] = [
      '#type' => 'select',
      '#title' => $this->t('Country of birth'),
      '#required' => TRUE,
      '#default_value' => 'ca',
      '#options' => [
        'ca' => $this->t('Canada'),
        'es' => $this->t('Spain'),
        'fr' => $this->t('France'),
        'us' => $this->t('United States'),
        'uk' => $this->t('United Kingdom'),
      ],
    ];

    $form['personal_data']['personal_info']['photo'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Photo'),
      '#upload_validators' => [
        'file_validate_extensions' => ['jpg png'],
      ],
      '#required' => TRUE,
      '#description' => 'JPG or PNG file.'
    ];

    $form['personal_data']['contact_info'] = [
      '#type' => 'details',
      '#title' => $this->t('Contact information'),
    ];

    $form['personal_data']['contact_info']['address'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Address'),
    ];

    $form['personal_data']['contact_info']['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email address'),
      '#default_value' => $this->currentUser()->getEmail(),
      '#required' => TRUE,
    ];

    $form['personal_data']['contact_info']['phone'] = [
      '#type' => 'tel',
      '#title' => $this->t('Phone'),
    ];

    // Tab 2: academic data
    $form['academic_data'] = [
      '#type' => 'details',
      '#title' => $this->t('Academic data'),
      '#group' => 'resume'
    ];

    $form['academic_data']['degree_info'] = [
      '#type' => 'details',
      '#title' => $this->t('Degree'),
      '#open' => TRUE,
    ];

    $form['academic_data']['degree_info']['degree'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Degree'),
    ];

    $form['academic_data']['degree_info']['element_machine_name'] = [
      '#type' => 'machine_name',
      '#description' => $this->t('A unique name for this item. It must only contain lowercase letters, numbers, and underscores.'),
      '#machine_name' => [
        'source' => ['academic_data', 'degree_info', 'degree'],
        // Required callback for machine_name validation.
        'exists' => [static::class, 'machineNameExists'],
      ]
    ];

    $form['academic_data']['degree_info']['end_date'] = [
      '#type' => 'date',
      '#title' => $this->t('End date'),
    ];

    $form['academic_data']['degree_info']['study_center'] = [
      '#type' => 'radios',
      '#title' => $this->t('Study center'),
      '#options' => [
        1 => $this->t('University of Toronto'),
        2 => $this->t('McGill University'),
        3 => $this->t('University of British Columbia'),
        4 => $this->t('University of Alberta'),
        5 => $this->t('McMaster University'),
      ],
    ];

    // Tab 3: work experience
    $form['work_experience'] = [
      '#type' => 'details',
      '#title' => $this->t('Work experience'),
      '#group' => 'resume'
    ];

    $form['work_experience']['description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Description'),
    ];

    $form['work_experience']['resume_file'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Attach resume'),
      '#upload_validators' => [
        'file_validate_extensions' => ['pdf'],
      ],
      '#required' => TRUE,
      '#description' => 'PDF file.'
    ];

    // Tab 4: complementary training
    $form['complementary_training'] = [
      '#type' => 'details',
      '#title' => $this->t('Complementary training'),
      '#group' => 'resume'
    ];

    $form['complementary_training']['courses'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Courses taken'),
      '#options' => [
        1 => $this->t('Human resources'),
        2 => $this->t('Office automation'),
        3 => $this->t('Project management'),
        4 => $this->t('Administration'),
        5 => $this->t('Drupal'),
      ],
      '#description' => 'Multiple choice.'
    ];

    // Hidden uid
    $form['user_id'] = [
      '#type' => 'hidden',
      '#value' => $this->currentUser()->id(),
    ];

    if ($this->currentUser()->isAuthenticated()) {
      $form['actions']['submit'] = [
        '#type' => 'submit',
        '#value' => $this->t('Submit'),
      ];
    } else {
      $form['message'] = [
        '#markup' => $this->t('You must be logged in to submit a resume.')
      ];
    }

    return $form;
  }

  // Callback required by the machine_name element to check whether
  // a machine name already exists. For this form, machine names are
  // not stored, so always return FALSE.
  public static function machineNameExists($value) {
    return FALSE;
  }


  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->messenger()->addMessage($this->t('The resume has been successfully received.'));
  }

}