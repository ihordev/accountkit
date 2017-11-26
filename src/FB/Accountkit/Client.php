<?php

declare(strict_types=1);

namespace FB\Accountkit;

use FB\Accountkit\DTO\Account;
use FB\Accountkit\Exception\ClientException;
use GuzzleHttp\Client as GuzzleClient;
use FB\Accountkit\Exception\ResponseFormatException;
use FB\Accountkit\Exception\ResponseFieldException;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

class Client implements ClientInterface
{
    const APP_ACCESS_TOKEN_FORMAT = 'AA|%s|%s';

    /**
     * @var Config
     */
    private $config;

    /**
     * @var GuzzleClient
     */
    private $guzzleClient;

    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->guzzleClient = new GuzzleClient();
    }

    public function logout(string $authAccessToken)
    {
        // @todo: Implement logout() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getAccessToken(string $requestCode): string
    {
        $appId = $this->config->getAppId();
        $appSecret = $this->config->getAppSecret();
        $appAccessToken = sprintf(self::APP_ACCESS_TOKEN_FORMAT, $appId, $appSecret);

        $params = [
            'query' => [
                'grant_type' => 'authorization_code',
                'code' => $requestCode,
                'access_token' => $appAccessToken,
            ]
        ];

        $response = $this->get($this->config->getAccessTokenUrl(), $params);

        $authResponse = $this->convertResponse($response);

        if (!isset($authResponse['access_token'])) {
            throw new ResponseFieldException('access_token');
        }

        return $authResponse['access_token'];
    }

    /**
     * {@inheritdoc}
     */
    public function getUser(string $authAccessToken): Account
    {
        $hash = hash_hmac(
            'sha256',
            $authAccessToken,
            $this->config->getAppSecret()
        );

        $params = [
            'query' => [
                'appsecret_proof' => $hash,
                'access_token' => $authAccessToken,
            ]
        ];

        $response = $this->get(
            $this->config->getUserDataUrl(),
            $params
        );

        $userResponse = $this->convertResponse($response);

        if (!isset($userResponse['id'])) {
            throw new ResponseFieldException('account id');
        }
        if (!isset($userResponse['phone'])) {
            throw new ResponseFieldException('phone');
        }

        if (!isset($userResponse['phone']['number'])) {
            throw new ResponseFieldException('phone:number');
        }

        if (!isset($userResponse['phone']['country_prefix'])) {
            throw new ResponseFieldException('phone:country_prefix');
        }

        if (!isset($userResponse['phone']['number'])) {
            throw new ResponseFieldException('phone:number');
        }

        return new Account(
            $userResponse['id'],
            $userResponse['phone']['number'],
            $userResponse['phone']['country_prefix'],
            $userResponse['phone']['number']
        );
    }

    /**
     * @param string $url
     * @param array $params
     * @return ResponseInterface
     * @throws ClientException
     */
    private function get(string $url, array $params): ResponseInterface
    {
        try {
            return $this->guzzleClient->request('GET', $url, $params);
        } catch (\Exception $e) {
            throw new ClientException($e);
        }
    }

    /**
     * @param Response $response
     * @return array
     */
    private function convertResponse(Response $response): array
    {
        $responseHeader = $response->getHeaderLine('content-type');

        if (false === preg_match('/application\/json/', $responseHeader)) {
            throw new ResponseFormatException;
        }

        return json_decode($response->getBody()->getContents(), true);
    }
}
