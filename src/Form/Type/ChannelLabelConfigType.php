<?php

declare(strict_types=1);

namespace Niiph\SyliusProductLabelPlugin\Form\Type;

use Niiph\SyliusProductLabelPlugin\Entity\ChannelLabelConfig;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\PositiveOrZero;

class ChannelLabelConfigType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('label', LabelAutocompleteChoiceType::class, [
                'label' => 'niiph_product_label.form.label.new_product_label',
                'required' => false,
                'multiple' => false,
                'placeholder' => '---',
            ])
            ->add('days', IntegerType::class, [
                'label' => 'niiph_product_label.form.label.new_product_days',
                'empty_data' => 0,
                'constraints' => [new NotNull(groups: ['sylius']), new PositiveOrZero(groups: ['sylius'])],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => ChannelLabelConfig::class,
            ],
        );
    }

    public function getBlockPrefix(): string
    {
        return 'niiph_channel_label_config';
    }
}
