<?php

declare(strict_types=1);

namespace Niiph\SyliusProductLabelPlugin\Entity;

use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TranslationInterface;

interface LabelTranslationInterface extends IdentifiableInterface, TranslationInterface, ResourceInterface
{
    public function getText(): ?string;

    public function setText(?string $text): void;
}
