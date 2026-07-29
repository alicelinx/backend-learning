<?php

namespace Drupal\forcontu_cat\Form;

use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Database\Connection;
use Drupal\Core\Url;
use Drupal\node\NodeInterface;

/**
 * Implements the Delete form controller.
 */

class ForcontuCatDeleteForm extends ConfirmFormBase {
  protected $database;
  protected $node;

  public function __construct(Connection $database) {
    $this->database = $database;
  }

  public static function create(ContainerInterface $container) {
    return new static (
      $container->get('database')
    );
  }

  public function getFormId() {
    return 'forcontu_cat_delete';
  }

  public function buildForm(array $form,
                            FormStateInterface $form_state,
                            ?NodeInterface $node = NULL) {
    $this->node = $node;
    return parent::buildForm($form, $form_state);
  }

  public function getQuestion() {
    return $this->t('Are you sure you want to delete node "%title" (%nid) from <em>forcontu_cat_messages</em> table?', [
      '%title' => $this->node->getTitle(),
      '%nid' => $this->node->id()
    ]);
  }

  public function getConfirmText() {
    return $this->t('Delete');
  }

  public function getCancelText() {
    return $this->t('Don\'t Delete');
  }

  public function getCancelUrl() {
    return Url::fromRoute('forcontu_cat.messages');
  }

  public function submitForm(array &$form,
                              FormStateInterface $form_state) {
    $this->database->delete('forcontu_cat_messages')
      ->condition('nid', $this->node->id())
      ->execute();

      $this->messenger()->addMessage($this->t('The node has been removed from the table.'));
      $form_state->setRedirectUrl($this->getCancelUrl());

      \Drupal::logger('forcontu_cat_messages')->notice(
        'Delete activated record for node %nid.',
        ['%nid' => $this->node->id()]
      );
  }
}