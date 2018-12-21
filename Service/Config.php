<?php

namespace Samiax\GoogleApiBundle\Service;

class Config
{
    /**
     * @var string
     */
    protected $credentialFile;

    /**
     * @var string
     */
    protected $applicationName;

    /**
     * @var string
     */
    protected $userAuthKey;

    /**
     * @var string
     */
    protected $scopes;

    /**
     * Set credential file
     *
     * @param string $credentialFile
     */
    public function setCredentialFile($credentialFile)
    {
        $this->credentialFile = $credentialFile;
    }

    /**
     * Get credential file
     *
     * @return string
     */
    public function getCredentialFile()
    {
        return $this->credentialFile;
    }

    /**
     * Set application name
     *
     * @param string $applicationName
     */
    public function setApplicationName($applicationName)
    {
        $this->applicationName = $applicationName;
    }

    /**
     * Get application name
     *
     * @return string
     */
    public function getApplicationName()
    {
        return $this->applicationName;
    }

    /**
     * Set analytics view id
     *
     * @param string $analyticsViewId
     */
    public function setAnalyticsViewId($analyticsViewId)
    {
        $this->analyticsViewId = (string) $analyticsViewId;
    }

    /**
     * Get analytics view id
     *
     * @return string
     */
    public function getAnalyticsViewId()
    {
        return $this->analyticsViewId;
    }

    /**
     * Set scopes
     *
     * @param string $scopes
     */
    public function setScopes($scopes)
    {   
        $this->scopes = $scopes;
    }

    /**
     * Get scopes
     *
     * @return string
     */
    public function getScopes()
    {
        return $this->scopes;
    }
}
