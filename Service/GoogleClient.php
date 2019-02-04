<?php

namespace Samiax\GoogleApiBundle\Service;

class GoogleClient
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * @var string
     */
    protected $googleClient;

    /**
     * Set config
     *
     * @param string $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * Get config
     *
     * @return string
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Set google client
     *
     * @param string $googleClient
     */
    public function setGoogleClient($googleClient)
    {
        $this->googleClient = $googleClient;
    }

    /**
     * Get google client
     *
     * @return string
     */
    public function getGoogleClient()
    {
        return $this->googleClient;
    }

    /**
     * Constructor
     *
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $googleClient = new \Google_Client();
        $googleClient->setApplicationName($config->getApplicationName());
        $googleClient->setAuthConfig($config->getCredentialFile());

        $this->setConfig($config);
        $this->setGoogleClient($googleClient);
    }

    /**
     * Get analytics service
     */
    public function analytics()
    {
        return new \Google_Service_AnalyticsReporting($this->getGoogleClient());
    }

    /**
     * Get shopping content service
     */
    public function shoppingContent()
    {
        return new \Google_Service_ShoppingContent($this->getGoogleClient());
    }

    /**
     * Get youtube service
     */
    public function youtube()
    {
        return new \Google_Service_YouTube($this->getGoogleClient());
    }
}
