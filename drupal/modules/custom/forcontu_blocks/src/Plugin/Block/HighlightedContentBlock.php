<?php

namespace Drupal\forcontu_blocks\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Database\Connection;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Provides the HighlightedContent block.
 * 
 * @Block(
 *    id = "forcontu_blocks_highlighted_content_block",
 *    admin_label = @Translation("Highlighted Content")
 * )
 */
class HighlightedContentBlock extends BlockBase implements ContainerFactoryPluginInterface {
  protected $database;
  protected $currentUser;
  protected $entityTypeManager;

  public function __construct(array $configuration,
                              $plugin_id,
                              $plugin_definition,
                              AccountInterface $current_user,
                              Connection $database,
                              EntityTypeManagerInterface $entity_type_manager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->currentUser = $current_user;
    $this->database = $database;
    $this->entityTypeManager = $entity_type_manager;
  }

  public static function create(ContainerInterface $container,
                                array $configuration,
                                $plugin_id,
                                $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('current_user'),
      $container->get('database'),
      $container->get('entity_type.manager'),
    );
  }

  public function build() {
    $node_number = $this->configuration['node_number'];
    $block_message = $this->configuration['block_message'];

    // Display the configured block message
    $build[] = [
      '#markup' => '<h3>' . $this->t($block_message) . '</h3>',
    ];

    // Query the database for highlighted nodes
    $result = $this->database->select('forcontu_node_highlighted', 'f')
      ->fields('f', ['nid'])
      ->condition('highlighted', 1)
      ->orderBy('nid', 'DESC')
      ->range(0, $node_number)
      ->execute();

    // Initialize the list and node storage
    $list = [];
    $node_storage = $this->entityTypeManager->getStorage('node');

    // Load each node and build a list of links
    foreach($result as $record) {
      $node = $node_storage->load($record->nid);
      $list[] = $node->toLink($node->getTitle())->toRenderable();
    }

    if (empty($list)) {
      $build[] = [
        '#markup' => '<h3>' . $this->t('No results found') . '</h3>',
      ];
    } else {
    // Render the list of highlighted nodes
      $build[] = [
        '#theme' => 'item_list',
        '#items' => $list,
        '#cache' => ['max-age' => 0],
      ];
    }
    return $build;
  }

  public function defaultConfiguration() {
    return [
      'block_message' => 'List of highlighted nodes',
      'node_number' => 5,
    ];
  }

  public function blockForm($form, FormStateInterface $form_state) {
    $form['forcontu_blocks_block_message'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Display message'),
      '#default_value' => $this->configuration['block_message'],
    ];

    $range = range(1, 10);
    $form['forcontu_blocks_node_number'] = [
      '#type' => 'select',
      '#title' => $this->t('Number of nodes'),
      '#default_value' => $this->configuration['node_number'],
      '#options' => array_combine($range, $range),
    ];
    return $form;
  }

  public function blockValidate($form, FormStateInterface $form_state) {
    if (strlen($form_state->getValue('forcontu_blocks_block_message')) < 10) {
      $this->t('The text must be at least 10 characters long');
    }
  }

  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['block_message'] =
      $form_state->getValue('forcontu_blocks_block_message');
    $this->configuration['node_number'] =
      $form_state->getValue('forcontu_blocks_node_number');
  }

  protected function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIfHasPermission($account, 'access highlighted content block');
  }
}