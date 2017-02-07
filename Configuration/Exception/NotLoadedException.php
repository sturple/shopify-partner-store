<?php

namespace Fgms\PartnerStoreBundle\Configuration\Exception;

/**
 * Thrown when no configuration is loaded into an
 * instance of @ref ConfigurationInterface and any
 * of the object's methods other than
 * @ref ConfigurationInterface::load is invoked.
 */
class NotLoadedException extends Exception
{
    public function __construct()
    {
        parent::__construct('ConfigurationInterface::load must be invoked first');
    }
}
