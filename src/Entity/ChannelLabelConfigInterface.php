<?php

declare(strict_types=1);

namespace Niiph\SyliusProductLabelPlugin\Entity;

interface ChannelLabelConfigInterface
{
    public function getLabel(): ?LabelInterface;

    public function setLabel(?LabelInterface $label): void;

    public function getDays(): ?int;

    public function setDays(?int $days): void;
}
