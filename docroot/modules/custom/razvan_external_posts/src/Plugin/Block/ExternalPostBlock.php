<?php

namespace Drupal\razvan_external_posts\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\razvan_external_posts\RHPosts;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ExternalPostBlock.
 *
 * @package Drupal\razvan_external_posts\Plugin\Block
 *
 * @Block(
 *  id = "razvan_external_post_block",
 *  admin_label = @Translation("An external block")
 * )
 */
class ExternalPostBlock extends BlockBase implements ContainerFactoryPluginInterface {

  protected $rhPosts;

  /**
   *
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static($configuration, $plugin_id, $plugin_definition, $container->get('razvan_external_posts.rh_posts'));
  }

  /**
   *
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, RHPosts $rhPosts) {
    $this->rhPosts = $rhPosts;
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }


  public function defaultConfiguration() {
    return [
      'post_id' => 2,
    ];
  }

  public function blockForm($form, FormStateInterface $form_state) {
    $form['block_example_string_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Post ID'),
      '#description' => $this->t('Which post do you want to see'),
      '#default_value' => $this->configuration['post_id'],
    ];
    return $form;
  }

  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['post_id']
      = $form_state->getValue('block_example_string_text');
  }


  public function build() {
    return $this->rhPosts->renderPost($this->configuration['post_id']);
  }

}
