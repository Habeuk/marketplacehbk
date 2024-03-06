<?php

namespace Drupal\marketplacehbk\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for marketplacehbk routes.
 */
class MarketplacehbkController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
