<?php

declare(strict_types=1);

namespace Niiph\SyliusProductLabelPlugin\Form\Type;

use Niiph\SyliusProductLabelPlugin\Entity\Label;
use Sylius\Bundle\ResourceBundle\Form\EventSubscriber\AddCodeFormSubscriber;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceTranslationsType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LabelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->addEventSubscriber(new AddCodeFormSubscriber())
            ->add('textColor', ColorType::class, [
                'label' => 'niiph_product_label.form.label.text_color',
            ])
            ->add('backgroundColor', ColorType::class, [
                'label' => 'niiph_product_label.form.label.background_color',
            ])
            ->add('translations', ResourceTranslationsType::class, [
                'entry_type' => LabelTranslationType::class,
                'label' => 'niiph_product_label.form.label.translations',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => Label::class,
            ],
        );
    }

    public function getBlockPrefix(): string
    {
        return 'niiph_label';
    }
}
