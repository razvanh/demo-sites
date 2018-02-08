<?php

namespace Drupal\razvan_external_posts\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Provides a field type that shows external posts.
 *
 * @FieldType(
 *   id = "razvan_external_posts_field",
 *   label = @Translation("External posts"),
 *   default_formatter = "razvan_external_posts_field_formatter",
 *   default_widget = "razvan_external_posts_field_widget",
 * )
 */

class RazvanEternalPostsField extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return array(
      // columns contains the values that the field will store
      'columns' => array(
        // List the values that the field will save. This
        // field will only save a single value, 'value'
        'post_id' => array(
          'type' => 'int',
          'size' => 'normal',
          'not null' => FALSE,
        ),
      ),
    );
  }


  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties = [];
    $properties['post_id'] = DataDefinition::create('integer');

    return $properties;
  }



}