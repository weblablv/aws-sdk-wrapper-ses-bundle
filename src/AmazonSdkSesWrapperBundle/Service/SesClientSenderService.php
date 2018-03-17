<?php

namespace WebLabLv\Bundle\AmazonSdkSesWrapperBundle\Service;

use WebLabLv\AmazonSdkSesWrapper\Service\SesClientSender;

final class SesClientSenderService extends SesClientSender
{
    /**
     * @param string|null $profile
     * @return SesClientSender
     */
    public function setProfile(string $profile = null): SesClientSender
    {
        false === empty($profile) && parent::setProfile($profile);
        return $this;
    }

    /**
     * @param string|null $version
     * @return SesClientSender
     */
    public function setVersion(string $version = null): SesClientSender
    {
        false === empty($version) && parent::setVersion($version);
        return $this;
    }

    /**
     * @param string|null $region
     * @return SesClientSender
     */
    public function setRegion(string $region = null): SesClientSender
    {
        false === empty($region) && parent::setRegion($region);
        return $this;
    }

}
