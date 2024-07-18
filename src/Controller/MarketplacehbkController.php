<?php

namespace Drupal\marketplacehbk\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for marketplacehbk routes.
 */
class MarketplacehbkController extends ControllerBase {
  
  /**
   * Permet de recuperer les files definis dans le champs images pour le champs
   * galleries.
   * Il permet egalement de reduire le nombre d'image à 3.
   */
  public function build($commerce_bundle) {
    $query = $this->entityTypeManager()->getStorage('commerce_product')->getQuery()->accessCheck(TRUE);
    $query->condition('type', $commerce_bundle);
    $results = $query->execute();
    // dump($storage);
    if ($results) {
      $products = $this->entityTypeManager()->getStorage('commerce_product')->loadMultiple($results);
      foreach ($products as $product) {
        /**
         *
         * @var \Drupal\commerce_product\Entity\Product $product
         */
        $newGalleries = $product->get('field_galleries')->getValue();
        $field_images = $product->get('field_images')->getValue();
        $addNewItem = false;
        foreach ($field_images as $item) {
          if (!$this->inGalleries($newGalleries, $item['target_id'])) {
            $addNewItem = true;
            $newGalleries[] = [
              'target_id' => $item['target_id'],
              'dispplay' => 1,
              'description' => $item['alt']
            ];
          }
        }
        // s'il ya plus de 3 images, on reduit.
        if (count($field_images) > 3) {
          $field_images = array_slice($field_images, 0, 3);
          $product->set('field_images', $field_images);
          $addNewItem = true;
        }
        if ($addNewItem) {
          $product->set('field_galleries', $newGalleries);
          $product->save();
          dump($product->toArray());
        }
      }
    }
    $this->messenger()->addStatus("Tous les contenus ont été mis à jour");
    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!')
    ];
    
    return $build;
  }
  
  protected function inGalleries(array $newGalleries, $target_id) {
    foreach ($newGalleries as $item) {
      if ($item['target_id'] == $target_id)
        return true;
    }
    return false;
  }
  
}
