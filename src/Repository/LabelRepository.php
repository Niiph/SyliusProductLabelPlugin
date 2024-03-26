<?php

namespace Niiph\SyliusProductLabelPlugin\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Niiph\SyliusProductLabelPlugin\Entity\Label;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\ResourceRepositoryTrait;

class LabelRepository extends ServiceEntityRepository implements LabelRepositoryInterface
{
    use ResourceRepositoryTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Label::class);
    }
}
