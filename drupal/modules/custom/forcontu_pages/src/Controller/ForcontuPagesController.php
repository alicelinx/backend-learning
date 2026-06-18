<?php

/**
 * @file
 * Contains \Drupal\forcontu_pages\Controller\ForcontuPagesController.
 */

namespace Drupal\forcontu_pages\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Drupal\user\UserInterface;
use Drupal\node\NodeInterface;
use Drupal\Core\Url;
use Drupal\Core\Link;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Datetime\DateFormatter;

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

  public function node(NodeInterface $node) {
    $list[] = $this->t('Title: @title',
                        ['@title' => $node->getTitle()]);
    $list[] = $this->t('Type: @type',
                        ['@type' => $node->getType()]);
    $list[] = $this->t('Creation date: @createdate',
                        ['@createdate' => \Drupal::service('date.formatter')->format($node->getCreatedTime(), 'short')]);

    $output = [
      '#theme' => 'item_list',
      '#items' => $list,
      '#title' => $this->t('Node data:')
    ];
    return $output;
  }

  public function links() {
    // link to /admin/structure/blocks
    $url1 = Url::fromRoute('block.admin_display');
    $link1 = Link::fromTextAndUrl($this->t('Go to the Block administration page'), $url1);

    // link to /admin/content
    $url2 = Url::fromRoute('system.admin_content');
    $link2 = Link::fromTextAndUrl($this->t('Go to the Content administration page'), $url2);

    // link to /admin/people
    $url3 = Url::fromRoute('entity.user.collection');
    $link3 = Link::fromTextAndUrl($this->t('Go to the User administration page'), $url3);

    // link to the front page of the site
    $url4 = Url::fromRoute('<front>');
    $link4 = Link::fromTextAndUrl($this->t('Go to Front page'), $url4);

    // link to /node/1
    $url5 = Url::fromRoute('entity.node.canonical', ['node' => 1]);
    $link5 = Link::fromTextAndUrl($this->t('Link to node/1'), $url5);

    // link to /node/1/edit
    $url6 = Url::fromRoute('entity.node.edit_form', ['node' => 1]);
    $link6 = Link::fromTextAndUrl($this->t('Link to node/1/edit'), $url6);

    // link to external www.forcontu.com, open in new window
    $url7 = Url::fromUri('https://www.forcontu.com');
    $link_options = [
      'attributes' => [
        'class' => [
          'external-link',
          'list',
        ],
        'target' => '_blank',
        'title' => 'Go to www.forcontu.com',
      ]
    ];
    $url7->setOptions($link_options);
    $link7 = Link::fromTextAndUrl($this->t('Link to www.forcontu.com'), $url7);

    $list[] = $link1;
    $list[] = $link2;
    $list[] = $link3;
    $list[] = $link4;
    $list[] = $link5;
    $list[] = $link6;
    $list[] = $link7;


    $output = [
      '#theme' => 'item_list',
      '#items' => $list,
      '#title' => $this->t('Examples of links:')
    ];
    return $output;
  }

  public function tab1() {
    $output = '<p>' . $this->t('This is the content of Tab 1') . '</p>';

    if ($this->currentUser->hasPermission('administer nodes')) {
      $output .= '</p>' . $this->t('This extra text is only displayed if the current user can administer nodes.') . '</p>';
    }

    return [
      '#markup' => $output,
    ];
  }

  public function tab2() {
    return [
      '#markup' => '<p>' . $this->t('This is the content of Tab 2') . '</p>',
    ];
  }

  public function tab3() {
    $current_time = \Drupal::time()->getRequestTime();
    $formatted_date = $this->dateFormatter->format(
      $current_time,
      'custom',
      'Y:m:d'
    );
    return [
      '#markup' => '<p>' . $this->t(
        'This is the content of Tab 3<br>Current date: @date', ['@date' => $formatted_date]) . '</p>',
    ];
  }

  public function tab3a() {
    return [
      '#markup' => '<p>' . $this->t('This is the content of Tab 3a') . '</p>',
    ];
  }

  public function tab3b() {
    return [
      '#markup' => '<p>' . $this->t('This is the content of Tab 3b') . '</p>',
    ];
  }

  public function extratab() {
    return [
      '#markup' => '<p>' . $this->t('This is the content of extratab') . '</p>',
    ];
  }

  public function action1() {
    return [
      '#markup' => '<p>' . $this->t('This is the content of action1') . '</p>',
    ];
  }

  public function action2() {
    return [
      '#markup' => '<p>' . $this->t('This is the content of action2') . '</p>',
    ];
  }

  // Injects 'current_user' & 'date.formatter' service
  protected $currentUser;
  protected $dateFormatter;
  public function __construct(AccountInterface $current_user, DateFormatter $date_formatter) {
    $this->currentUser = $current_user;
    $this->dateFormatter = $date_formatter;
  }
  
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('current_user'),
      $container->get('date.formatter')
    );
  }



}