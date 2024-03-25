<?php

namespace Drupal\marketplacehbk\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\search_api\Entity\Index;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\search_api\Utility\QueryHelper;

class TestBuildQueryViewsController extends ControllerBase {
  /**
   *
   * @var QueryHelper
   */
  protected $QueryHelper;
  
  public static function create(ContainerInterface $container) {
    return new static($container->get('search_api.query_helper'));
  }
  
  public function __construct(QueryHelper $QueryHelper) {
    $this->QueryHelper = $QueryHelper;
  }
  
  public function test_build_query_views($index_id) {
    $options = [];
    $index = Index::load($index_id);
    if ($index) {
      /**
       *
       * @var \Drupal\search_api\Query\Query $queryIndex
       */
      $queryIndex = $this->QueryHelper->createQuery($index, $options);
      dump($queryIndex->__toString());
    }
    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!')
    ];
    
    return $build;
  }
  
}