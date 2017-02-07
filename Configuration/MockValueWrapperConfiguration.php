<?php

namespace Fgms\PartnerStoreBundle\Configuration;

class MockValueWrapperConfiguration extends ValueWrapperConfiguration
{
    public function __construct(\Fgms\ValueWrapper\ValueWrapper $wrapper = null)
    {
        if (!is_null($wrapper)) $this->setValueWrapper($wrapper);
    }

    public function load($str)
    {
        throw new \LogicException('Unimplemented');
    }
}
