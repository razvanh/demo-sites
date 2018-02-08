<?php

namespace Drupal\razvan_external_posts\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * The id of anexternal post.
 *
 * @FieldWidget(
 *   id = "razvan_external_posts_field_widget",
 *   label = @Translation("Post id"),
 *   field_types = {
 *     "razvan_external_posts_field",
 *   }
 * )
 */

class RazvanExternalPostsWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element['post_id'] = $element + [
      '#type' => 'textfield',
        '#default_value' => isset($items[$delta]->post_id) ? $items[$delta]->post_id : NULL,
      ];
    // Build the element render array.
    return $element;
  }

}
