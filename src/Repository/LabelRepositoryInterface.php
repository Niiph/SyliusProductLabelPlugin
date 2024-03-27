<?php

declare(strict_types=1);

namespace Niiph\SyliusProductLabelPlugin\Repository;

use Doctrine\Persistence\ObjectRepository;
use Sylius\Component\Resource\Repository\RepositoryInterface;

interface LabelRepositoryInterface extends ObjectRepository, RepositoryInterface
{
    public function findByNamePart(string $phrase, string $locale, ?int $limit = null): array;
}
