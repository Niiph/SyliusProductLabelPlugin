<?php

namespace Niiph\SyliusProductLabelPlugin\Entity;

use Doctrine\Common\Collections\Collection;

interface HasLabelsInterface
{
    /** @return Collection<LabelInterface> */
    public function getLabels(): Collection;

    public function addLabel(LabelInterface $label): void;

    public function removeLabel(LabelInterface $label): void;
}
