<?php

declare(strict_types=1);

namespace Niiph\SyliusProductLabelPlugin\Form\Extension;

use Niiph\SyliusProductLabelPlugin\Form\Type\ChannelLabelConfigType;
use Sylius\Bundle\ChannelBundle\Form\Type\ChannelType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

class ChannelTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        $builder
        ->add('channelLabelConfig', ChannelLabelConfigType::class, [
            'label' => false,
        ])
        ;
    }

    public static function getExtendedTypes(): iterable
    {
        return [ChannelType::class];
    }
}
