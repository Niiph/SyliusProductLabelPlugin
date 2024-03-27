<?php

declare(strict_types=1);

namespace Niiph\SyliusProductLabelPlugin\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

trait IdentifiableTrait
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Serializer\Groups(['Autocomplete'])]
    protected ?int $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
