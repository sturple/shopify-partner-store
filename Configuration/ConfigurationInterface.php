<?php

namespace Fgms\PartnerStoreBundle\Configuration;

/**
 * An interface which may be implemented to generate
 * or update Form and Field entities based on configuration
 * data given as a string.
 */
interface ConfigurationInterface
{
    /**
     * Loads a configuration string into the object.
     *
     * Once this method succeeds subsequent operations
     * will operate on the loaded configuration until
     * this method is invoked again.
     *
     * If this method does not complete successfully
     * the internal state of the object is undefined
     * and the only things which may be safely done
     * with the object are to allow its lifetime to
     * expire or invoke this method again.
     *
     * @param string $str
     */
    public function load($str);

    /**
     * Gets the ID of the Form entity which the loaded
     * configuration updates.
     *
     * @return int|null
     *  The ID or null if the configuration creates a new
     *  Form entity.
     */
    public function getId();

    /**
     * Gets key of the Form entity which the loaded
     * configuration updates.
     *
     * @return string|null
     *  The key or null if the configuration creates
     *  a new Form entity.
     */
    public function getKey();
}
