<?php

declare(strict_types=1);

namespace Niiph\SyliusProductLabelPlugin\Entity;

use Doctrine\Common\Collections\Collection;

interface HasLabelsInterface
{
    /** @return Collection<array-key, LabelInterface >*/
    public function getLabels(): Collection;

    public function addLabel(LabelInterface $label): void;

    public function removeLabel(LabelInterface $label): void;
}
