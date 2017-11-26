<?php

namespace FB\Accountkit\Exception;

use RuntimeException;

class ResponseFormatException extends RuntimeException
{
    /**
     * @param \Exception $e
     */
    public function __construct(\Exception $e = null)
    {
        parent::__construct('Unexpected Response Format', 500, $e);
    }
}
