<?php

declare(strict_types=1);

namespace Niiph\SyliusProductLabelPlugin\Entity;

use Doctrine\ORM\Mapping as ORM;

trait ChannelLabelConfigTrait
{
    #[ORM\OneToOne(targetEntity: ChannelLabelConfig::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    protected ?ChannelLabelConfigInterface $channelLabelConfig = null;

    public function getChannelLabelConfig(): ?ChannelLabelConfigInterface
    {
        return $this->channelLabelConfig;
    }

    public function setChannelLabelConfig(?ChannelLabelConfigInterface $channelLabelConfig): void
    {
        $this->channelLabelConfig = $channelLabelConfig;
    }
}
