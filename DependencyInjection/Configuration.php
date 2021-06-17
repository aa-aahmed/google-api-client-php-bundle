<?php

namespace Samiax\GoogleApiBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('samiax_google_api');
        $rootNode = $treeBuilder->getRootNode();
        $rootNode
            ->children()
            ->scalarNode('credential_file')->end()
            ->scalarNode('application_name')->end()
            ->end();
        return $treeBuilder;
    }
}
