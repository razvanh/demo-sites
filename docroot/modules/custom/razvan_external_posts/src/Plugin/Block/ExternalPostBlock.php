<?php

namespace Drupal\razvan_external_posts\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\razvan_external_posts\RHPosts;
use Symfony\Component\DependencyInjection\ContainerInterface;

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

  /**
   *
   */
  public function build() {
    return $this->rhPosts->renderPost(2);
  }

}
