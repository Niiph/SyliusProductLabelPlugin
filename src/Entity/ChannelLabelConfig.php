<?php

declare(strict_types=1);

namespace Niiph\SyliusProductLabelPlugin\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table]
#[ORM\MappedSuperclass]
class ChannelLabelConfig implements ChannelLabelConfigInterface
{
    use IdentifiableTrait;

    #[ORM\ManyToOne(targetEntity: Label::class, cascade: ['persist'])]
    #[ORM\JoinColumn(onDelete: 'SET NULL')]
    protected ?LabelInterface $label = null;

    #[ORM\Column(type: 'integer')]
    protected ?int $days = 30;

    public function getLabel(): ?LabelInterface
    {
        return $this->label;
    }

    public function setLabel(?LabelInterface $label): void
    {
        $this->label = $label;
    }

    public function getDays(): ?int
    {
        return $this->days;
    }

    public function setDays(?int $days): void
    {
        $this->days = $days;
    }
}
