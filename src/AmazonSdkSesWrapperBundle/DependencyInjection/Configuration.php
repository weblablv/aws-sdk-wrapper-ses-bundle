<?php

namespace Weblab\Bundle\AmazonSdkSesWrapperBundle\DependencyInjection;

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
		$root = $treeBuilder->root($this->alias);
		
		$root
			->children()
				->scalarNode('profile')->isRequired()->end()
				->arrayNode('credentials')->isRequired()
					->children()
						->scalarNode('access_key_id')->isRequired()->end()
						->scalarNode('access_secret_key')->isRequired()->end()
					->end()
				->end()
				->scalarNode('region')->isRequired()->end()
			->end();
		
		return $treeBuilder;
	}
}
