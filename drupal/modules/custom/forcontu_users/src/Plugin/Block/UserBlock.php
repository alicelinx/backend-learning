<?php

namespace Drupal\forcontu_users\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides the User block.
 * 
 * @Block(
 *    id = "forcontu_users_user_block",
 *    admin_label = @Translation("User")
 * )
 */
class UserBlock extends BlockBase {
  public function build() {
    $current_user = \Drupal::currentUser();
    $user = \Drupal\user\Entity\User::load($current_user->id());

    $roles = array_diff(
      $user->getRoles(),
      ['anonymous',  'authenticated']
    );

    $date = \Drupal::service('date.formatter')
      ->format($user->getLastLoginTime(), 'custom', 'Y-m-d');

    
    $build[] = [
      '#markup' =>
        '<p>' . $this->t('User ID: ') . $user->id() . '</p>' .
        '<p>' . $this->t('Display name: ') . $user->getDisplayName() . '</p>' .
        '<p>' . $this->t('Email: ') . $user->getEmail() . '</p>' .
        '<p>' . $this->t('Roles: ') . implode(', ', $roles) . '</p>' .
        '<p>' . $this->t('Last login date: ') . $date . '</p>' 
    ];
    
    return $build;
  }

  protected function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIfHasPermission($account, 'access user block')
      ->cachePerUser();
  }
}