<?php

declare(strict_types=1);

namespace Niiph\SyliusProductLabelPlugin\EventListener;

use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;
use Niiph\SyliusProductLabelPlugin\Entity\ChannelLabelConfig;
use Niiph\SyliusProductLabelPlugin\Entity\HasChannelLabelConfigInterface;
use Sylius\Component\Core\Model\Channel;
use Sylius\Component\Core\Model\ChannelInterface;

#[AsEntityListener(Events::prePersist, 'prePersist', entity: Channel::class)]
class ChannelLabelConfigListener
{
    public function prePersist(ChannelInterface $channel): void
    {
        if (!$channel instanceof HasChannelLabelConfigInterface) {
            return;
        }
        if (null !== $channel->getChannelLabelConfig()) {
            return;
        }

        $channelLabelConfig = new ChannelLabelConfig();
        $channel->setChannelLabelConfig($channelLabelConfig);
    }
}
