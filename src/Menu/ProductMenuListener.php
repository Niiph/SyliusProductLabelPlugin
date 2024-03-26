<?php

declare(strict_types=1);

namespace Niiph\SyliusProductLabelPlugin\Menu;

use Sylius\Bundle\AdminBundle\Event\ProductMenuBuilderEvent;
use Sylius\Bundle\AdminBundle\Menu\ProductFormMenuBuilder;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

class ProductMenuListener
{
    #[AsEventListener(ProductFormMenuBuilder::EVENT_NAME)]
    public function addLabelMenuTab(ProductMenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();
        $menu
            ->addChild('labels')
            ->setAttribute('template', '@NiiphSyliusProductLabelPlugin/Admin/Product/Tab/_labels.html.twig')
            ->setLabel('niiph_product_label.ui.labels')
        ;
    }
}
