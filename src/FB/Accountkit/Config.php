<?php

declare(strict_types=1);

namespace FB\Accountkit;

class Config
{
    const ACCESS_TOKEN_URL = 'https://graph.accountkit.com/v1.2/access_token';
    const USER_DATA_URL = 'https://graph.accountkit.com/v1.2/me';

    /**
     * @var string
     */
    private $appId;

    /**
     * @var string
     */
    private $appSecret;

    /**
     * Config constructor.
     * @param string $appId
     * @param string $appSecret
     */
    public function __construct(string $appId, string $appSecret)
    {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
    }

    /**
     * @return string
     */
    public function getAccessTokenUrl(): string
    {
        return self::ACCESS_TOKEN_URL;
    }

    /**
     * @return string
     */
    public function getUserDataUrl(): string
    {
        return self::USER_DATA_URL;
    }

    /**
     * @return string
     */
    public function getAppId(): string
    {
        return $this->appId;
    }

    /**
     * @return string
     */
    public function getAppSecret(): string
    {
        return $this->appSecret;
    }
}
