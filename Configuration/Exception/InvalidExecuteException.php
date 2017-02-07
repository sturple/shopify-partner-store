<?php

namespace Fgms\PartnerStoreBundle\Configuration\Exception;

/**
 * Thrown when @ref ConfigurationInterface::execute is
 * invoked but the parameter does not match the value
 * returned by @ref ConfigurationInterface::getKey.
 */
class InvalidExecuteException extends Exception
{
    public function __construct()
    {
        parent::__construct('Parameter to ConfigurationInterface::execute does not match return value of ConfigurationInterface::getKey');
    }
}
