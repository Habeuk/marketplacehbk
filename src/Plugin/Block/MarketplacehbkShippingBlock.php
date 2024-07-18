<?php

namespace Drupal\marketplacehbk\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Permet de retouner la durée minimal d'un produit.
 * Pour la meme ville :
 * * 1- Si la commande se paie avant <12h00, la livraison peut se faire en apres
 * midi.
 * 2- Si la commande se paie au dela de >12h00, la livraison peut se faire le
 * lendemain avant 12h00.
 *
 *
 * @Block(
 *   id = "hbk_shipping_by_product",
 *   admin_label = @Translation("Example"),
 *   category = @Translation("marketplacehbk")
 * )
 */
class MarketplacehbkShippingBlock extends BlockBase {
  
  /**
   *
   * {@inheritdoc}
   */
  public function build() {
    $build['content'] = [
      '#markup' => $this->t('It works!')
    ];
    return $build;
  }
}
