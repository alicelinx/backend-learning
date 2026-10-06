<?php

namespace Drupal\forcontu_entities\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the Section entity.
 * 
 * @ConfigEntityType(
 *   id = "forcontu_entities_section",
 *   label = @Translation("Section"),
 *   handlers = {
 *     "list_builder" = "Drupal\forcontu_entities\SectionListBuilder",
 *     "form" = {
 *       "add" = "Drupal\forcontu_entities\Form\SectionForm",
 *       "edit" = "Drupal\forcontu_entities\Form\SectionForm",
 *       "delete" = "Drupal\forcontu_entities\Form\SectionDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\forcontu_entities\SectionHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "forcontu_entities_section",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *    "id" = "id",
 *    "label" = "label",
 *    "uuid" = "uuid",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "uuid",
 *     "urlPattern",
 *     "color",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/forcontu_entities_section/{forcontu_entities_section}",
 *     "add-form" = "/admin/structure/forcontu_entities_section/add",
 *     "edit-form" = "/admin/structure/forcontu_entities_section/{forcontu_entities_section}/edit",
 *     "delete-form" = "/admin/structure/forcontu_entities_section/{forcontu_entities_section}/delete",
 *     "collection" = "/admin/structure/forcontu_entities_section"
 *   }
 * )
 */

class Section extends ConfigEntityBase implements SectionInterface {
  /**
   * The Section ID.
   * 
   * @var string
   */
  protected $id;

  /**
   * The Section label.
   * 
   * @var string
   */
  protected $label;

  /**
   * URL pattern.
   * 
   * @var string
   */
  protected $urlPattern;

  /**
   * Color (HEX format)
   * 
   * @var string 
   */
  protected $color;

  /**
   * {@inheritdoc}
   */
  public function getUrlPattern() {
    return $this->urlPattern;
  }

  /**
   * {@inheritdoc}
   */
  public function getColor() {
    return $this->color;
  }

  /**
   * {@inheritdoc}
   */
  public function setUrlPattern($pattern) {
    $this->urlPattern = $pattern;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setColor($color) {
    $this->color = $color;
    return $this;
  }
}