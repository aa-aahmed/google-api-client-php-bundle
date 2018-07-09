<?php

namespace Samiax\GoogleApiClientPhpBundle\Service;

class GoogleClient
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * @var string
     */
    protected $client;

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
     * Set client
     *
     * @param string $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * Get client
     *
     * @return string
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Constructor
     *
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $client = new \Google_Client();
        $client->setApplicationName($config->getApplicationName());
        $client->setAuthConfig($config->getCredentialFile());
        $client->setScopes($config->getScopes());

        $this->setConfig($config);
        $this->setClient($client);
    }

    /**
     * Get analytics
     */
    public function analytic()
    {
        return new \Google_Service_AnalyticsReporting($this->getClient());
    }
}
