<?php

declare(strict_types=1);

namespace Niiph\SyliusProductLabelPlugin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Niiph\SyliusProductLabelPlugin\Repository\LabelRepository;
use Sylius\Component\Resource\Model\ToggleableTrait;
use Sylius\Component\Resource\Model\TranslatableTrait;
use Sylius\Component\Resource\Model\TranslationInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints\CssColor;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity(LabelRepository::class)]
#[ORM\Table]
#[UniqueEntity(['code'])]
#[ORM\MappedSuperclass]
class Label implements LabelInterface
{
    use IdentifiableTrait;
    use ToggleableTrait;
    use TranslatableTrait {
        __construct as private initializeTranslationsCollection;
    }

    public function __construct()
    {
        $this->initializeTranslationsCollection();
    }

    #[ORM\Column(type: 'string')]
    #[NotBlank]
    protected ?string $code = null;

    #[ORM\Column(type: 'string', nullable: true)]
    #[CssColor]
    protected ?string $textColor = null;

    #[ORM\Column(type: 'string', nullable: true)]
    #[CssColor]
    protected ?string $backgroundColor = null;

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    public function getTextColor(): ?string
    {
        return $this->textColor;
    }

    public function setTextColor(?string $textColor): void
    {
        $this->textColor = $textColor;
    }

    public function getBackgroundColor(): ?string
    {
        return $this->backgroundColor;
    }

    public function setBackgroundColor(?string $backgroundColor): void
    {
        $this->backgroundColor = $backgroundColor;
    }

    public function getText(): ?string
    {
        return $this->getTranslation()->getText();
    }

    public function setText(?string $text): void
    {
        $this->getTranslation()->setText($text);
    }

    protected function createTranslation(): TranslationInterface
    {
        return new LabelTranslation();
    }
}
