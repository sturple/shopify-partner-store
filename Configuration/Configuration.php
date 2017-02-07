<?php

namespace Fgms\PartnerStoreBundle\Configuration;

/**
 * A convenience base class for implementing classes
 * which implement @ref ConfigurationInterface.
 */
abstract class Configuration implements ConfigurationInterface
{
    /**
     * Checks to ensure the value provided to @ref execute
     * matches the value returned by @ref getKey and @ref getId
     * and throws an appropriate exception if this is not the case.
     *
     * @param Form|null $form
     */
    protected function checkExecute(\Fgms\PartnerStoreBundle\Entity\Form $form = null)
    {
        //  ID may be set or unset:
        //
        //  If it's set we need to have a form with that exact ID
        $id = $this->getId();
        if (!is_null($id)) {
            if (is_null($form) || ($form->getId() !== $id)) throw new Exception\InvalidExecuteException();
            return;
        }
        //  If it's unset that means that we're going by key,
        //  which means the keys have to match assuming a
        //  Form entity was provided (if no Form entity is
        //  provided we're creating)
        if (is_null($form)) return;
        if ($this->getKey() !== $form->getKey()) throw new Exception\InvalidExecuteException();
    }
}
