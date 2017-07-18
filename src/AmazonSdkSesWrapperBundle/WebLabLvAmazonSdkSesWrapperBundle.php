<?php

namespace WebLabLv\Bundle\AmazonSdkSesWrapperBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\Extension\Extension;

use WebLabLv\Bundle\AmazonSdkSesWrapperBundle\DependencyInjection\WebLabLvAmazonSdkSesWrapperExtension;

final class WebLabLvAmazonSdkSesWrapperBundle extends Bundle
{
	/**
	 * @return Extension
	 */
	public function getContainerExtension(): Extension
	{
		return new WebLabLvAmazonSdkSesWrapperExtension();
	}
}
