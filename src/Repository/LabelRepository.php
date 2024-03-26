<?php

declare(strict_types=1);

namespace Niiph\SyliusProductLabelPlugin\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Niiph\SyliusProductLabelPlugin\Entity\Label;
use Niiph\SyliusProductLabelPlugin\Entity\LabelTranslation;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\ResourceRepositoryTrait;

class LabelRepository extends ServiceEntityRepository implements LabelRepositoryInterface
{
    use ResourceRepositoryTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Label::class);
    }

    public function findByNamePart(string $phrase, string $locale, ?int $limit = null): array
    {
        /** @var array $result */
        $result = $this->createQueryBuilder('o')
            ->leftJoin(LabelTranslation::class, 'translation', 'WITH', 'translation.translatable = o.id')
            ->andWhere('translation.text LIKE :text')
            ->andWhere('translation.locale = :locale')
            ->setParameter('text', '%' . $phrase . '%')
            ->setParameter('locale', $locale)
            ->setMaxResults($limit)
            ->orderBy('translation.text')
            ->getQuery()
            ->getResult();

        return $result;
    }
}
