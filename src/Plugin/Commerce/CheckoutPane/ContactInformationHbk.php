<?php

namespace Drupal\marketplacehbk\Plugin\Commerce\CheckoutPane;

use Drupal\commerce_checkout\Plugin\Commerce\CheckoutPane\ContactInformation;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides the contact information pane.
 *
 * @CommerceCheckoutPane(
 *   id = "contact_information_hbk",
 *   label = @Translation("Contact information with phone number"),
 *   default_step = "",
 *   wrapper_element = "fieldset",
 * )
 */
class ContactInformationHbk extends ContactInformation {
  
  /**
   *
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'data-country' => 'cm',
      'data-geo' => 1,
      'data-preferred' => [
        'cm'
      ],
      'email_required' => true
    ] + parent::defaultConfiguration();
  }
  
  /**
   *
   * {@inheritdoc}
   */
  public function buildPaneForm(array $pane_form, FormStateInterface $form_state, array &$complete_form) {
    $pane_form = parent::buildPaneForm($pane_form, $form_state, $complete_form);
    $pane_form['phone'] = [
      '#type' => 'phone_international',
      '#title' => $this->t('Phone number'),
      // '#country' => $this->configuration['data-country'],
      '#geolocation' => (bool) $this->configuration['data-geo'],
      '#preferred_countries' => $this->configuration['data-preferred'],
      '#default_value' => $this->order->getData('phone', '+237'),
      '#attributes' => [ // not work.
                          // 'placeholder' => $this->t('Your phone number,
                          // example: 694 900 622')
      ]
    ];
    $pane_form['email']['#attributes']['placeholder'] = $this->t('Please enter your email address');
    $pane_form['email']['#required'] = $this->configuration['email_required'];
    return $pane_form;
  }
  
  /**
   * Pour validation on se rassure que l'email ou le telephone est definit.
   *
   * {@inheritdoc}
   */
  public function validatePaneForm(array &$pane_form, FormStateInterface $form_state, array &$complete_form) {
    $values = $form_state->getValue($pane_form['#parents']);
    if (empty($values['email']) || empty($values['phone'])) {
      $form_state->setError($pane_form, $this->t('You must enter your email address or phone number'));
    }
  }
  
  /**
   *
   * {@inheritdoc}
   */
  public function submitPaneForm(array &$pane_form, FormStateInterface $form_state, array &$complete_form) {
    parent::submitPaneForm($pane_form, $form_state, $complete_form);
    $values = $form_state->getValue($pane_form['#parents']);
    $this->order->setData('phone', $values['phone']);
  }
  
}