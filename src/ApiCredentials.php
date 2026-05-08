<?php

declare(strict_types=1);

namespace CCVShop\Api;

class ApiCredentials
{
    private string $hostName;
    private string $public;
    private string $secret;

    /**
     * @param string $hostName
     * @param string $public
     * @param string $secret
     */
    public function __construct(string $hostName, string $public, string $secret)
    {
        $this->hostName = $hostName;
        $this->public = $public;
        $this->secret = $secret;
    }

    /**
     * @return string
     */
    public function getHostName(): string
    {
        return $this->hostName;
    }

    /**
     * @return string
     */
    public function getPublic(): string
    {
        return $this->public;
    }

    /**
     * @return string
     */
    public function getSecret(): string
    {
        return $this->secret;
    }
}
