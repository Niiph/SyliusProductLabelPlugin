<?php

namespace Niiph\SyliusProductLabelPlugin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\AbstractTranslation;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity]
#[ORM\Table]
#[ORM\MappedSuperclass]
class LabelTranslation extends AbstractTranslation implements LabelTranslationInterface
{
    use IdentifiableTrait;

    #[ORM\Column(type: 'string')]
    #[NotBlank]
    protected ?string $text = null;

    #[ORM\Column(type: 'string')]
    protected ?string $locale = null;

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): void
    {
        $this->text = $text;
    }
}
