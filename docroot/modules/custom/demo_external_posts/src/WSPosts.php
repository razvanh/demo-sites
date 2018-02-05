<?php

namespace Drupal\demo_external_posts;

use Drupal\Core\Config\ConfigFactory;
use GuzzleHttp\Client;

/**
 * {@inheritdoc}
 */
class WSPosts {

  protected $client;

  protected $baseUrl;

  /**
   * {@inheritdoc}
   */
  public function __construct(Client $client, ConfigFactory $config) {

    $this->client = $client;
    $this->baseUrl = $config->get('demo_external_posts.settings')->get('demo_external_posts_ws_posts_url');

  }

  /**
   * {@inheritdoc}
   */
  public function getPosts() {
    $request = $this->client->get($this->baseUrl . 'posts');
    return json_decode($request->getBody());
  }

  /**
   * {@inheritdoc}
   */
  public function getPost($post_id) {
    $request = $this->client->get($this->baseUrl . 'posts/' . $post_id);
    return json_decode($request->getBody());
  }

  /**
   * {@inheritdoc}
   */
  public function renderPost($post_id) {

    $post = $this->getPost($post_id);

    $elements['title'] = [
      '#type' => 'html_tag',
      '#tag' => 'h1',
      '#value' => $post->title,
    ];

    $elements['body'] = [
      '#type' => 'html_tag',
      '#tag' => 'div',
      '#value' => $post->body,
    ];

    return $elements;
  }

}
