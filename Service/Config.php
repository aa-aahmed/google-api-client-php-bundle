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
}
