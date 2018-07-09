<?php

namespace Samiax\GoogleApiClientPhpBundle\DependencyInjection;

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
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('google_api_client_php');

        $rootNode
            ->children()
                ->scalarNode('credential_file')->end()
                ->scalarNode('application_name')->end()
                ->scalarNode('analytics_view_id')->end()
                ->append($this->getScopes())
            ->end()
        ;

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }

    private function getScopes()
    {
        $node = new ArrayNodeDefinition('scopes');

        $node->prototype('scalar')->end();

        return $node;
    }
}
