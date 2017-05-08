<?php

namespace Drupal\twitter_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a Last tweet block.
 *
 * @Block(
 *   id = "twitter_block",
 *   admin_label = @Translation("Twitter block"),
 * )
 */
class TwitterBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $content = '';
    $config = \Drupal::config('twitter_block.settings');
    $settings = array(
      'consumer_key' => $config->get('consumer_key'),
      'consumer_secret' => $config->get('consumer_secret'),
      'oauth_access_token' => $config->get('access_token'),
      'oauth_access_token_secret' => $config->get('access_token_secret'),
    );

    // Set here the Twitter account from where getting latest tweets
    $screen_name = 'netglooweb';

    // Get timeline using TwitterAPIExchange
    $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
    $getfield = "?count=1";
    $requestMethod = 'GET';

    $twitter = new \TwitterAPIExchange($settings);
    $user_timeline = $twitter
      ->setGetfield($getfield)
      ->buildOauth($url, $requestMethod)
      ->performRequest();

    $messages = json_decode($user_timeline);
    if (!empty($messages)) {
      foreach ($messages as $message) {
        $content .= '<div class="twitter-message">' . $message->text . '</div>';
      }
    }
    return array(
      '#markup' => $content,
    );
  }

}