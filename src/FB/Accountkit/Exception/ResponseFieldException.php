<?php

namespace FB\Accountkit\Exception;

use RuntimeException;

class ResponseFieldException extends RuntimeException
{
    /**
     * @param string $fileNotFound
     * @param \Exception $e
     */
    public function __construct(string $fieldNotFound, \Exception $e = null)
    {
        parent::__construct(
            sprintf('Response Field Not Found - %s', $fieldNotFound),
            500,
            $e
        );
    }
}
