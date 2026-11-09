<?php

declare(strict_types=1);

namespace Drupal\oe_newsroom_node\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Access\AccessResultInterface;
use Drupal\Core\Block\Attribute\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\Cache;
use Drupal\Core\Plugin\Context\EntityContextDefinition;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\Url;
use Drupal\oe_newsroom\Newsroom;

/**
 * Block to subscribe to node notifications.
 */
#[Block(
  id: 'oe_newsroom_node_subscribe_block',
  admin_label: new TranslatableMarkup('Newsroom node subscribe block'),
  category: new TranslatableMarkup('OE Newsroom Node'),
  context_definitions: [
    'node' => new EntityContextDefinition('entity:node', new TranslatableMarkup('Node')),
  ],
)]
class NodeSubscribeBlock extends BlockBase {

  public function build(): array {
    /** @var \Drupal\node\NodeInterface $node */
    $node = $this->getContextValue('node');
    $url = Url::fromRoute('oe_newsroom_node.subscribe_form', ['node' => $node->id()]);

    return [
      '#theme' => 'oe_newsroom_node_subscribe_button',
      '#url' => $url,
      '#label' => $this->t('Subscribe'),
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function blockAccess(AccountInterface $account): AccessResultInterface {
    return AccessResult::allowedIfHasPermission($account, 'subscribe to newsroom node notifications');
  }

  public function getCacheTags(): array {
    return Cache::mergeTags(parent::getCacheTags(), [
      'config:' . Newsroom::CONFIG_NAME,
      'config:oe_newsroom_node.settings',
    ]);
  }

}
