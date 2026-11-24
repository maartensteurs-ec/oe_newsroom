<?php

declare(strict_types=1);

namespace Drupal\oe_newsroom_node\Hook;

use Drupal\Core\Hook\Attribute\Hook;

/**
 * Implements theme hooks for the oe_newsroom_node module.
 */
class NodeThemeHook {

  /**
   * Implements hook_theme().
   */
  #[Hook('theme')]
  public function theme(): array {
    return [
      'oe_newsroom_node_subscribe_button' => [
        'variables' => [
          'url' => NULL,
          'label' => NULL,
          'attributes' => [],
        ],
      ],
    ];
  }

}
