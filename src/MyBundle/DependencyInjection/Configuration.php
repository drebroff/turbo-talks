<?php

namespace App\MyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('my_bundle');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->scalarNode('greeting_prefix')
                    ->defaultValue('Hello')
                    ->info('The prefix to use when greeting someone')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}