<?php

namespace WebLabLv\Bundle\AmazonSdkSesWrapperBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

use InvalidArgumentException;

final class WebLabLvAmazonSdkSesWrapperExtension extends Extension
{
	/**
	 * @param array $configs An array of configuration values
	 * @param ContainerBuilder $container A ContainerBuilder instance
	 *
	 * @throws InvalidArgumentException When provided tag is not defined in this extension
	 */
	public function load(array $configs, ContainerBuilder $container)
	{
		$configuration = new Configuration($this->getAlias());
		$config = $this->processConfiguration($configuration, $configs);

		$container->setParameter('weblablv_amazon_sdk_ses_wrapper.profile', (string)$config['profile']);
		$container->setParameter('weblablv_amazon_sdk_ses_wrapper.credentials.access_key_id', (string)$config['credentials']['access_key_id']);
		$container->setParameter('weblablv_amazon_sdk_ses_wrapper.credentials.access_secret_key', (string)$config['credentials']['access_secret_key']);
		$container->setParameter('weblablv_amazon_sdk_ses_wrapper.region', (string)$config['region']);

		$loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
		$loader->load('services.yml');
	}

	/**
	 * @return string
	 */
	public function getAlias(): string
	{
		return 'weblablv_amazon_sdk_ses_wrapper';
	}
}
