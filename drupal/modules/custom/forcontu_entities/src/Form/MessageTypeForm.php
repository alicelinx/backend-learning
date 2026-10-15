<?php

namespace Drupal\forcontu_entities\Form;

use Drupal\Core\Entity\BundleEntityFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the Message type entity.
 */
class MessageTypeForm extends BundleEntityFormBase {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $message_type = $this->entity;

    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $message_type->label(),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $message_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\forcontu_entities\Entity\MessageType::load',
      ],
      '#disabled' => !$message_type->isNew(),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $message_type = $this->entity;
    $status = $message_type->save();

    $this->messenger()->addStatus(
      $status === SAVED_NEW
        ? $this->t('Created the %label Message type.', ['%label' => $message_type->label()])
        : $this->t('Updated the %label Message type.', ['%label' => $message_type->label()])
    );

    $form_state->setRedirect('entity.forcontu_entities_message_type.collection');

    return $status;
  }

}