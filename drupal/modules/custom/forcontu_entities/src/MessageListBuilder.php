<?php

namespace Drupal\forcontu_entities;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Url;
use Drupal\Core\Datetime\DateFormatterInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\EntityStorageInterface;

/**
 * Defines a class to build a listing of Message entities.
 * 
 * @ingroup forcontu_entities
 */
class MessageListBuilder extends EntityListBuilder {
  
  protected $dateFormatter;

  public function __construct(EntityTypeInterface $entity_type, EntityStorageInterface $storage, DateFormatterInterface $date_formatter) {
    parent::__construct($entity_type, $storage);

    $this->dateFormatter = $date_formatter;
  }

  /**
   * {@inheritdoc}
   */
  public static function createInstance(ContainerInterface $container, EntityTypeInterface $entity_type) {
    return new static(
      $entity_type,
      $container->get('entity_type.manager')->getStorage($entity_type->id()),
      $container->get('date.formatter')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Message ID');
    $header['from'] = $this->t('From');
    $header['to'] = $this->t('To');
    $header['subject'] = $this->t('Subject');
    $header['created'] = $this->t('Created');

    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\forcontu_entities\Entity\Message */

    $row['id'] = $entity->id();
    $row['from'] = $entity->getOwner()->getAccountName();
    $row['to'] = $entity->getUserTo()->getAccountName();

    $row['subject'] = [
      'data' => [
        '#type' => 'link',
        '#title' => $entity->label(),
        '#url' => new Url(
          'entity.forcontu_entities_message.edit_form',
          [
            'forcontu_entities_message' => $entity->id(),
          ]
        ),
      ],
    ];

    $row['created'] = $this->dateFormatter->format($entity->getCreatedTime(), 'short');
    return $row + parent::buildRow($entity);
  }
}