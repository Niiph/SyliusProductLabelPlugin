<?php

namespace Niiph\SyliusProductLabelPlugin\Entity;

use Sylius\Component\Resource\Model\CodeAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\ToggleableInterface;
use Sylius\Component\Resource\Model\TranslatableInterface;

interface LabelInterface extends
    IdentifiableInterface,
    ToggleableInterface,
    TranslatableInterface,
    ResourceInterface,
    CodeAwareInterface
{
    public function getTextColor(): ?string;

    public function setTextColor(?string $textColor): void;

    public function getBackgroundColor(): ?string;

    public function setBackgroundColor(?string $backgroundColor): void;
}
