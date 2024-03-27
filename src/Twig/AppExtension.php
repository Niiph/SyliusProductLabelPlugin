<?php

declare(strict_types=1);

namespace Niiph\SyliusProductLabelPlugin\Twig;

use DateTime;
use Niiph\SyliusProductLabelPlugin\Entity\HasChannelLabelConfigInterface;
use Niiph\SyliusProductLabelPlugin\Entity\LabelInterface;
use Sylius\Component\Core\Context\ShopperContextInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function __construct(
        private readonly ShopperContextInterface $shopperContext,
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('entityIsNew', [$this, 'entityIsNew']),
            new TwigFunction('getNewLabel', [$this, 'getNewLabel']),
        ];
    }

    public function entityIsNew(object $entity): ?bool
    {
        if (!method_exists($entity, 'getCreatedAt')) {
            return false;
        }
        /** @var HasChannelLabelConfigInterface $channel */
        $channel = $this->shopperContext->getChannel();

        $days = $channel->getChannelLabelConfig()?->getDays();
        if (null === $days) {
            return false;
        }
        $createdAt = $entity->getCreatedAt();
        if (null === $createdAt) {
            return false;
        }

        return $createdAt->diff(new DateTime())->d <= $days;
    }

    public function getNewLabel(): ?LabelInterface
    {
        /** @var HasChannelLabelConfigInterface $channel */
        $channel = $this->shopperContext->getChannel();

        return $channel->getChannelLabelConfig()?->getLabel();
    }
}
