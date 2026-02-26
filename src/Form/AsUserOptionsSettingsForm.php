<?php

namespace Drupal\as_user_options\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a settings form for A&S User Options module.
 *
 * Allows administrators to configure which toolbar links and user menu items
 * should be hidden based on user roles.
 */
class AsUserOptionsSettingsForm extends ConfigFormBase {


  /**
   * Config settings.
   *
   * @var string
   */
  const SETTINGS = 'as_user_options.settings';

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'as_user_options_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      static::SETTINGS,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(static::SETTINGS);

    $form['hideusertabs'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Remove USER tab for all roles'),
      '#default_value' => $config->get('hideusertabs') ?? FALSE,
    ];

    $form['hidemanage'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Hide MANAGE for users who are faculty, student, or staff who are not editors or contributors'),
      '#default_value' => $config->get('hidemanage') ?? FALSE,
    ];

    $form['hideshortcuts'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Hide SHORTCUTS for all roles'),
      '#default_value' => $config->get('hideshortcuts') ?? FALSE,
    ];

    $form['hideviewprofile'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Hide VIEW PROFILE for all roles'),
      '#default_value' => $config->get('hideviewprofile') ?? FALSE,
    ];

    $form['hideeditprofile'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Hide EDIT PROFILE for all roles'),
      '#default_value' => $config->get('hideeditprofile') ?? FALSE,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->configFactory->getEditable(static::SETTINGS)
      ->set('hideusertabs', $form_state->getValue('hideusertabs'))
      ->set('hidemanage', $form_state->getValue('hidemanage'))
      ->set('hideshortcuts', $form_state->getValue('hideshortcuts'))
      ->set('hideviewprofile', $form_state->getValue('hideviewprofile'))
      ->set('hideeditprofile', $form_state->getValue('hideeditprofile'))
      ->save();

    parent::submitForm($form, $form_state);
  }
}
