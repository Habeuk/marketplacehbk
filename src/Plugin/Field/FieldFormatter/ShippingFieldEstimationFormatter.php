<?php

namespace Drupal\marketplacehbk\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Field\Plugin\Field\FieldFormatter\StringFormatter;

/**
 * Plugin implementation of the 'string' formatter.
 * Pour la meme ville :
 * 1- Si la commande se paie avant <12h00, la livraison peut se faire en apres
 * midi.
 * 2- Si la commande se paie au dela de >12h00, la livraison peut se faire le
 * lendemain avant 12h00.
 *
 * Pour les villes differentes :
 * Aucun impact.
 *
 *
 * @FieldFormatter(
 *   id = "marketplacehbk_shipping_estimation",
 *   label = @Translation("marketplacehbk shipping estimation"),
 *   field_types = {
 *     "integer",
 *   },
 *   entity_type = "commerce_product"
 * )
 */
class ShippingFieldEstimationFormatter extends StringFormatter {
  
  /**
   *
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'layoutgenentitystyles_view' => 'marketplacehbk/field-shipping',
      'text_before' => [
        "value" => 'Livraison dans',
        'format' => 'basic_html'
      ]
    ] + parent::defaultSettings();
  }
  
  /**
   *
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements[] = [
      'value' => [
        '#type' => 'html_tag',
        '#tag' => 'div',
        '#attributes' => [
          'class' => [
            'field-bar',
            'd-flex'
          ]
        ],
        [
          '#type' => 'html_tag',
          '#tag' => 'div',
          '#attributes' => [],
          '#value' => $this->getSetting('text_before') ? $this->getSetting('text_before')['value'] : ''
        ],
        parent::viewElements($items, $langcode)
      ]
    ];
    return $elements;
  }
  
  /**
   *
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    return [
      // Utilile pour mettre à jour le style.
      'layoutgenentitystyles_view' => [
        '#type' => 'hidden',
        '#value' => 'marketplacehbk/field-shipping'
      ],
      'text_before' => [
        '#type' => 'text_format',
        '#title' => 'Text before',
        '#default_value' => $this->getSetting('text_before') ? $this->getSetting('text_before')['value'] : '',
        '#format' => 'basic_html'
      ]
    ] + parent::settingsForm($form, $form_state);
  }
}