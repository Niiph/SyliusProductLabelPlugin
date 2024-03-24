<?php

declare(strict_types=1);

namespace Niiph\SyliusProductLabelPlugin\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    /**
     * @psalm-suppress UnusedVariable
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('niiph_sylius_product_label_plugin');
        $rootNode = $treeBuilder->getRootNode();

        return $treeBuilder;
    }
}
