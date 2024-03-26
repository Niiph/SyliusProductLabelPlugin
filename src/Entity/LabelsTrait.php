<?php

declare(strict_types=1);

namespace Niiph\SyliusProductLabelPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

trait LabelsTrait
{
    #[ORM\ManyToMany(targetEntity: Label::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinTable()]
    #[ORM\OrderBy(['priority' => 'DESC'])]
    protected Collection $labels;

    /**
     * @return Collection<array-key, LabelInterface>
     *
     * @psalm-return Collection<array-key, LabelInterface>
     */
    public function getLabels(): Collection
    {
        return $this->labels;
    }

    public function addLabel(LabelInterface $label): void
    {
        if (!$this->labels->contains($label)) {
            $this->labels->add($label);
        }
    }

    public function removeLabel(LabelInterface $label): void
    {
        if ($this->labels->contains($label)) {
            $this->labels->removeElement($label);
        }
    }

    protected function initialiseLabelCollection(): void
    {
        $this->labels = new ArrayCollection();
    }
}
