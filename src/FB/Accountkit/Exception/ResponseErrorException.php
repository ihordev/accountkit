<?php

namespace FB\Accountkit\Exception;

use RuntimeException;

class ResponseErrorException extends RuntimeException
{
    /**
     * @param \Exception $e
     */
    public function __construct(\Exception $e = null)
    {
        parent::__construct('Unexpected Response Error', 500, $e);
    }
}
