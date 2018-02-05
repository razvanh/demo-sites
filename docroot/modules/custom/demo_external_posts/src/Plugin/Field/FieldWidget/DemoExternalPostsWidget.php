<?php

namespace Drupal\demo_external_posts\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'demo_external_posts_widget' widget.
 *
 * @FieldWidget(
 *   id = "demo_external_posts_widget",
 *   label = @Translation("External Post"),
 *   field_types = {
 *     "demo_external_posts_field"
 *   }
 * )
 */
class DemoExternalPostsWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element['post_id'] = $element + [
      '#type' => 'textfield',
      '#default_value' => isset($items[$delta]->post_id) ? $items[$delta]->post_id : NULL,
    ];

    return $element;
  }

}
