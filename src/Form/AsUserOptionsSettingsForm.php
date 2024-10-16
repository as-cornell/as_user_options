<?php
namespace Drupal\as_user_options\Form;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\MapArray;


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
    // switch to db based config
    $form['removetabs'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Remove user tab for anonymous'),
      '#default_value' => $config->get('removetabs') ?? FALSE,
    );
    $form['hideviewprofile'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Hide view profile'),
      '#default_value' => $config->get('hideviewprofile') ?? FALSE,
    );
    $form['hideeditprofile'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Hide edit profile'),
      '#default_value' => $config->get('hideeditprofile') ?? FALSE,
    );
    return parent::buildForm($form,$form_state);
  }

  /**
   * Form submission handler.
   *
   *  $form -> An associative array containing the structure of the form.
   *  $form_state -> An associative array containing the current state of the form.
   */

  public function submitForm(array &$form, FormStateInterface $form_state) {

    // switch to db based config
    $this->configFactory->getEditable(static::SETTINGS)
      ->set('removetabs', $form_state->getValue('removetabs'))
      ->set('hideviewprofile', $form_state->getValue('hideviewprofile'))
      ->set('hideeditprofile', $form_state->getValue('hideeditprofile'))
      ->save();
  }
}
