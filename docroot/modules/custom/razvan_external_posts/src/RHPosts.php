<?php

namespace Drupal\razvan_external_posts;

use Drupal\Core\Config\ConfigFactory;
use GuzzleHttp\Client;

/**
 *
 */
class RHPosts {

  protected $baseURL;
  protected $client;

  /**
   *
   */
  public function __construct(Client $client, ConfigFactory $config) {
    $this->baseURL = $config->get('razvan_external_posts.settings')->get('razvan_external_posts_rh_posts_url');
    $this->client = $client;

  }

  /**
   *
   */
  public function posts() {
    $posts = json_decode($this->client->get($this->baseURL . '/posts')->getBody());
    return $posts;
  }

  /**
   *
   */
  public function post($postID) {

    $request = $this->client->get($this->baseURL . '/posts/' . $postID);
    return json_decode($request->getBody());

  }

  /**
   *
   */
  public function renderPost($post_id) {

    $post = $this->post($post_id);

    $elements['#title'] = $post->title;

    $elements['body'] = [
      '#type' => 'html_tag',
      '#tag' => 'div',
      '#value' => $post->body,
    ];

    return $elements;
  }

}
