<?php

namespace Drupal\marketplacehbk\Plugin\Commerce\ShippingMethod;

use Drupal\commerce_shipping\Plugin\Commerce\ShippingMethod\ShippingMethodBase;
use Drupal\commerce_price\Price;
use Drupal\commerce_shipping\Entity\ShipmentInterface;
use Drupal\commerce_shipping\PackageTypeManagerInterface;
use Drupal\commerce_shipping\ShippingRate;
use Drupal\commerce_shipping\ShippingService;
use Drupal\Core\Form\FormStateInterface;
use Drupal\state_machine\WorkflowManagerInterface;

/**
 * Provides the FlatRate shipping method.
 *
 * @CommerceShippingMethod(
 *   id = "marketplacehbk_cmr_livraison",
 *   label = @Translation("Cameroun livraison"),
 * )
 */
class CamerounLivriason extends ShippingMethodBase {
  
  /**
   *
   * {@inheritdoc}
   */
  public function calculateRates(ShipmentInterface $shipment) {
    $rates = [];
    $rates[] = new ShippingRate([
      'shipping_method_id' => $this->parentEntity->id(),
      'service' => $this->services['default'],
      'amount' => Price::fromArray($this->configuration['rate_amount']),
      'description' => $this->configuration['rate_description']
    ]);
    
    return $rates;
  }
}