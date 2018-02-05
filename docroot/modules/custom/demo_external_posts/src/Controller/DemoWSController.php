<?php

namespace Drupal\demo_external_posts\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\demo_external_posts\WSPosts;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Controller routines for this module's routes.
 */
class DemoWSController extends ControllerBase {

  protected $wsPosts;

  /**
   * {@inheritdoc}
   */
  public function __construct(WSPosts $wsPosts) {

    $this->wsPosts = $wsPosts;

  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('demo_external_posts.ws_posts')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function posts() {
    $posts = $this->wsPosts->getPosts();

    $posts_titles = [];
    foreach ($posts as $post) {

      if (!is_object($post)) {
        continue;
      }

      $posts_titles[] = Link::createFromRoute($post->title, 'demo_external_posts_ws_post', ['post_id' => $post->id]);
    }

    $posts_per_page = 10;
    $current_page = pager_default_initialize(count($posts_titles), $posts_per_page);
    $pages = array_chunk($posts_titles, $posts_per_page, TRUE);

    $elements['list'] = [
      '#theme' => 'item_list',
      '#items' => $pages[$current_page],
    ];

    $elements['pager'] = [
      '#type' => 'pager',
    ];

    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public function post($post_id) {

    return $this->wsPosts->renderPost($post_id);

  }

}
