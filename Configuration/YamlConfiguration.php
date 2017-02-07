<?php

namespace Fgms\PartnerStoreBundle\Configuration;

/**
 * Creates and updates Form and Field entities from
 * YAML configuration.
 */
class YamlConfiguration extends ValueWrapperConfiguration
{
    public function load($str)
    {
        $this->unsetValueWrapper();
        $yaml = \Symfony\Component\Yaml\Yaml::parse($str,\Symfony\Component\Yaml\Yaml::PARSE_OBJECT_FOR_MAP);
        if (!is_object($yaml)) throw new \Fgms\Yaml\Exception\TypeMismatchException(
            'object',
            $yaml,
            '',
            $str
        );
        $wrapper = new \Fgms\Yaml\ValueWrapper($yaml,$str);
        $this->setValueWrapper($wrapper);
    }
}
