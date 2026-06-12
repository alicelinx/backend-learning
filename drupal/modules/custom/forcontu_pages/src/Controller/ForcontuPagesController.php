<?php

/**
 * @file
 * Contains \Drupal\forcontu_pages\Controller\ForcontuPagesController.
 */

namespace Drupal\forcontu_pages\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Drupal\user\UserInterface;

class ForcontuPagesController extends ControllerBase {
  public function simple() {
    return [
      '#markup' => '<p>' . $this->t('This is a simple page (with no arguments)') . '</p>',
    ];
  }

  public function calculator($num1, $num2) {
    // a) Check the values provided are numeric, and if not, throw an error
    if (!is_numeric($num1) || !is_numeric($num2)) {
      throw new BadRequestHttpException($this->t('No numeric arguments specified.'));
    }

    // b) The results will be displayed in HTML list format (ul).
    //    Each element of the list is added to an array.
    $list[] = $this->t('@num1 + @num2 = @sum',
                        ['@num1' => $num1,
                         '@num2' => $num2,
                         '@sum' => $num1 + $num2]);
    $list[] = $this->t('@num1 - @num2 = @difference',
                        ['@num1' => $num1,
                         '@num2' => $num2,
                         '@difference' => $num1 - $num2]);
    $list[] = $this->t('@num1 * @num2 = @product',
                        ['@num1' => $num1,
                         '@num2' => $num2,
                         '@product' => $num1 * $num2]);
    
    // c) Avoid division by zero
    if ($num2 != 0) {
      $list[] = $this->t('@num1 / @num2 = @division',
                          ['@num1' => $num1,
                           '@num2' => $num2,
                           '@division' => $num1 / $num2]);
    } else {
      $list[] = $this->t('@num1 / @num2 = undefined (division by zero)',
                          ['@num1' => $num1,
                           '@num2' => $num2]);
    }

    // d) Transform $list into an HTML list (ul) using Drupal render API.
    $output = [
      '#theme' => 'item_list',
      '#items' => $list,
      '#title' => $this->t('Operations:'),
    ];
    
    return $output;
  }

  public function user(UserInterface $user) {
    $list[] = $this->t('Username: @username',
                        ['@username' => $user->getAccountName()]);
    $list[] = $this->t('Email: @email',
                        ['@email' => $user->getEmail()]);
    $list[] = $this->t('Roles: @roles',
                        ['@roles' => implode(", ", $user->getRoles())]);
    $list[] = $this->t('Last accessed time: @lastaccess',
                        ['@lastaccess' => \Drupal::service('date.formatter')->format($user->getLastAccessedTime(), 'short')]);

    $output = [
      '#theme' => 'item_list',
      '#items' => $list,
      '#title' => $this->t('User data:')
    ];
    return $output;
  }
}