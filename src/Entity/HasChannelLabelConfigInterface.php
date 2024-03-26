<?php

declare(strict_types=1);

namespace Niiph\SyliusProductLabelPlugin\Entity;

interface HasChannelLabelConfigInterface
{
    public function getChannelLabelConfig(): ?ChannelLabelConfigInterface;

    public function setChannelLabelConfig(?ChannelLabelConfigInterface $channelLabelConfig): void;
}
