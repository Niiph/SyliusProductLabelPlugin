<?php

declare(strict_types=1);

namespace Niiph\SyliusProductLabelPlugin\Menu;

use Sylius\Bundle\AdminBundle\Menu\MainMenuBuilder;
use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

class AdminMenuListener
{
    #[AsEventListener(MainMenuBuilder::EVENT_NAME)]
    public function removeOfficialSupportMenu(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();

        $submenu = $menu->getChild('catalog');
        $submenu
            ?->addChild('product_label', [
                'route' => 'niiph_product_label_admin_label_index',
            ])
            ->setLabel('niiph_product_label.ui.labels')
            ->setLabelAttribute('icon', 'tags');
    }
}
