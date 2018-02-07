<?php

namespace Drupal\razvan_external_posts\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\razvan_external_posts\RHPosts;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 *
 */
class RazvanExternalPostsController extends ControllerBase {

  protected $rhPosts;

  /**
   *
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('razvan_external_posts.rh_posts')
    );
  }

  /**
   *
   */
  public function __construct(RHPosts $rhPosts) {
    $this->rhPosts = $rhPosts;
  }

  /**
   *
   */
  public function posts() {
    // $rhPosts = \Drupal::service('razvan_external_posts.rh_posts');.
    $posts = $this->rhPosts->posts();

    $posts_titles = [];
    foreach ($posts as $post) {

      if (!is_object($post)) {
        continue;
      }

      $posts_titles[] = Link::createFromRoute($post->title, 'razvan_external_posts_post_detail', ['post_id' => $post->id]);
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
   *
   */
  public function post($post_id) {
    // $rhPosts = \Drupal::service('razvan_external_posts.rh_posts');.
    return $this->rhPosts->renderPost($post_id);
  }

}
