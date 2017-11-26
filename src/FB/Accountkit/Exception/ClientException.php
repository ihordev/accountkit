<?php

namespace FB\Accountkit\Exception;

use RuntimeException;

class ClientException extends RuntimeException
{
    /**
     * @param \Exception $e
     */
    public function __construct(\Exception $e = null)
    {
        parent::__construct('Accountkit transport error', 400, $e);
    }
}