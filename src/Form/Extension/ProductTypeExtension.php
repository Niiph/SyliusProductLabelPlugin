<?php

declare(strict_types=1);

namespace Niiph\SyliusProductLabelPlugin\Form\Extension;

use Niiph\SyliusProductLabelPlugin\Form\Type\LabelAutocompleteChoiceType;
use Niiph\SyliusProductLabelPlugin\Repository\LabelRepositoryInterface;
use Sylius\Bundle\ProductBundle\Form\Type\ProductType;
use Sylius\Bundle\ResourceBundle\Form\DataTransformer\RecursiveTransformer;
use Sylius\Bundle\ResourceBundle\Form\DataTransformer\ResourceToIdentifierTransformer;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\ReversedTransformer;

class ProductTypeExtension extends AbstractTypeExtension
{
    public function __construct(
        private readonly LabelRepositoryInterface $labelRepository,
    ) {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('labels', LabelAutocompleteChoiceType::class, [
                'required' => false,
                'label' => 'niiph_product_label.ui.labels',
                'multiple' => true,
            ]);

        $builder
            ->get('labels')->addModelTransformer(
                new ReversedTransformer(
                    new RecursiveTransformer(
                        new ResourceToIdentifierTransformer($this->labelRepository, 'code'),
                    ),
                ),
            )
            ->addModelTransformer(
                new RecursiveTransformer(
                    new ResourceToIdentifierTransformer($this->labelRepository, 'code'),
                ),
            );
    }

    public static function getExtendedTypes(): iterable
    {
        return [ProductType::class];
    }
}
