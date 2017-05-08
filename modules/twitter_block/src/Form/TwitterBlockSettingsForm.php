<?php

namespace Drupal\twitter_block\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure example settings for this site.
 */
class TwitterBlockSettingsForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'twitter_block_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'twitter_block.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('twitter_block.settings');

    $form['consumer_key'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Consumer key'),
      '#default_value' => $config->get('consumer_key'),
    );

    $form['consumer_secret'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Consumer secret'),
      '#default_value' => $config->get('consumer_secret'),
    );

    $form['access_token'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Access token'),
      '#default_value' => $config->get('access_token'),
    );

    $form['access_token_secret'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Access token secret'),
      '#default_value' => $config->get('access_token_secret'),
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('twitter_block.settings')
      ->set('consumer_key', $form_state->getValue('consumer_key'))
      ->set('consumer_secret', $form_state->getValue('consumer_secret'))
      ->set('access_token', $form_state->getValue('access_token'))
      ->set('access_token_secret', $form_state->getValue('access_token_secret'))
      ->save();

    parent::submitForm($form, $form_state);
  }
}