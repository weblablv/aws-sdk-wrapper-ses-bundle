<?php

namespace WebLabLv\Bundle\AmazonSdkSesWrapperBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{

    /**
     * @var string $alias
     */
    private $alias;

    /**
     * @param string $alias
     */
    public function __construct(string $alias)
    {
        $this->alias = $alias;
    }

    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder();
        $root        = $treeBuilder->root($this->alias);

        $root
            ->children()
                ->scalarNode('profile')->end()
                ->scalarNode('region')->end()
                ->scalarNode('path_to_credentials_file')->end()
                ->scalarNode('version')->end()
            ->end();

        return $treeBuilder;
    }
}
