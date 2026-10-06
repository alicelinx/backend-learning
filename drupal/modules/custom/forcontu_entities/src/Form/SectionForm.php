<?php

namespace Drupal\forcontu_entities\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class SectionForm.
 * 
 * @package Drupal\forcontu_entities\Form
 */
class SectionForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $forcontu_entities_section = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $forcontu_entities_section->label(),
      '#description' => $this->t('Label for the Section.'),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $forcontu_entities_section->id(),
      '#machine_name' => [
        'exists' => '\Drupal\forcontu_entities\Entity\Section::load',
      ],
      '#disabled' => !$forcontu_entities_section->isNew(),
    ];

    $form['urlPattern'] = [
      '#type' => 'textfield',
      '#title' => $this->t('URL pattern'),
      '#maxlength' => 255,
      '#default_value' => $forcontu_entities_section->getUrlPattern(),
      '#description' => $this->t('URL pattern for the Section.'),
      '#required' => TRUE,
    ];

    $form['color'] = [
      '#type' => 'color',
      '#title' => $this->t('Color'),
      '#default_value' => $forcontu_entities_section->getColor(),
      '#description' => $this->t("Color for the Section."),
      '#required' => TRUE,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $forcontu_entities_section = $this->entity;
    $status = $forcontu_entities_section->save();

    switch ($status) {
      case SAVED_NEW:
        $this->messenger()->addMessage($this->t('Created the %label Section.', [
          '%label' => $forcontu_entities_section->label(),
        ]));
        break;
      
      default:
        $this->messenger()->addMessage($this->t('Saved the %label Section.', [
          '%label' => $forcontu_entities_section->label(),
        ]));
    }
    $form_state->setRedirectUrl($forcontu_entities_section->toUrl('collection'));
  }
}