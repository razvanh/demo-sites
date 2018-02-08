<?php

namespace Drupal\razvan_external_posts\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\razvan_external_posts\RHPosts;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * External posts field formatter
 *
 * @FieldFormatter(
 *   id = "razvan_external_posts_field_formatter",
 *   label = @Translation("External posts"),
 *   field_types = {
 *     "razvan_external_posts_field"
 *   }
 * )
 */
class RazvanExternalPostsFieldFormatter extends FormatterBase implements ContainerFactoryPluginInterface {

  /**
   * The entity manager service
   *
   * @var \Drupal\Core\Entity\EntityManagerInterface
   */
  protected $rhPosts;

  /**
   *
   */
  public function __construct($plugin_id, $plugin_definition, FieldDefinitionInterface $field_definition, array $settings, $label, $view_mode, array $third_party_settings, RHPosts $rhPosts)  {
    $this->rhPosts = $rhPosts;
    parent::__construct($plugin_id,$plugin_definition,$field_definition,$settings,$label,$view_mode,$third_party_settings);
  }


  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = [];

    foreach ($items as $delta => $item) {
      // Render each element as markup.
      $element[$delta] = $this->rhPosts->renderPost($item->post_id);
    }

    return $element;
  }

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $plugin_id,
      $plugin_definition,
      $configuration['field_definition'],
      $configuration['settings'],
      $configuration['label'],
      $configuration['view_mode'],
      $configuration['third_party_settings'],
      // Add any services you want to inject here
      $container->get('razvan_external_posts.rh_posts')
    );
  }
}