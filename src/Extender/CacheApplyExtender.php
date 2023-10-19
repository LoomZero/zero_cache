<?php

namespace Drupal\zero_cache\Extender;

use Drupal;
use Drupal\zero_cache\Service\ZeroCacheService;
use Drupal\zero_preprocess\Base\PreprocessExtenderInterface;

class CacheApplyExtender implements PreprocessExtenderInterface {

  private ?ZeroCacheService $cache = NULL;

  public function getCache(): ZeroCacheService {
    if ($this->cache === NULL) {
      $this->cache = Drupal::service('zero_cache.service');
    }
    return $this->cache;
  }

  public function weight(): int {
    return 1000000;
  }

  public function config(): array {
    return [
      'title' => 'Cache apply in preprocess',
      'description' => 'Automatically apply cache tags in preprocess.',
    ];
  }

  public function registry(array &$zero, array $item, $name, array $theme_registry) { }

  public function preprocess(array &$vars, array $zero, array $template) {
    $this->getCache()->applyCache($vars);
  }

}
