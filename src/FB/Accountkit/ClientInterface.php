<?php

declare(strict_types=1);

namespace FB\Accountkit;

use FB\Accountkit\DTO\Account;
use FB\Accountkit\Exception\ResponseFieldException;

interface ClientInterface
{
    /**
     * @param  string $authAccessToken
     * @return Account
     * @throws ResponseFieldException
     */
    public function getUser(string $authAccessToken): Account;

    /**
     * @param  string $requestCode
     * @return string
     * @throws ResponseFieldException
     */
    public function getAccessToken(string $requestCode): string;

    /**
     * @param string $authAccessToken
     */
    public function logout(string $authAccessToken);

}
