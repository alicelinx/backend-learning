<?php

namespace Drupal\forcontu_blocks\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Form\FormBuilderInterface;

/**
 * Provides the NodeVoting block.
 * 
 * @Block(
 *    id = "forcontu_blocks_node_voting_block",
 *    admin_label = @Translation("Node voting")
 * )
 */
class NodeVotingBlock extends BlockBase implements ContainerFactoryPluginInterface {
  protected $currentRouteMatch;
  protected $formBuilder;

  public function __construct(array $configuration,
                              $plugin_id,
                              $plugin_definition,
                              RouteMatchInterface $current_route_match,
                              FormBuilderInterface $form_builder) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->currentRouteMatch = $current_route_match;
    $this->formBuilder = $form_builder;
  }

  public static function create(ContainerInterface $container,
                                array $configuration,
                                $plugin_id,
                                $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('current_route_match'),
      $container->get('form_builder')
    );
  }

  protected function blockAccess(AccountInterface $account) {
    $node = $this->currentRouteMatch->getParameter('node');
    if($node && $account->isAuthenticated()) {
      return AccessResult::allowed();
    } else {
      return AccessResult::forbidden();
    }
  }

  public function build() {
    $form =
      $this->formBuilder->getForm('Drupal\forcontu_blocks\Form\NodeVotingForm');
    return $form;
  }
}