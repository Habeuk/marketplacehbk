<?php

namespace Drupal\marketplacehbk\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides an example block.
 *
 * @Block(
 *   id = "marketplacehbk_example",
 *   admin_label = @Translation("Example"),
 *   category = @Translation("marketplacehbk")
 * )
 */
class ExampleBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build['content'] = [
      '#markup' => $this->t('It works!'),
    ];
    return $build;
  }

}
