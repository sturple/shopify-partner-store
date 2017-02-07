<?php

namespace Fgms\PartnerStoreBundle\Configuration;

/**
 * A convenience base class for implementing classes
 * which implement @ref ConfigurationInterface by loading
 * from a serialization format which may be represented as
 * a @ref ValueWrapper.
 */
abstract class ValueWrapperConfiguration extends Configuration
{
    private $root;

    /**
     * Unsets the internal @ref ValueWrapper so that
     * subsequent calls to methods on this object fail.
     */
    protected function unsetValueWrapper()
    {
        $this->root = null;
    }

    /**
     * Sets the internal @ref ValueWrapper so that
     * subsequent calls to methods on this object may
     * proceed.
     *
     * @param ValueWrapper $wrapper
     */
    protected function setValueWrapper(\Fgms\ValueWrapper\ValueWrapper $wrapper)
    {
        $this->root = $wrapper;
    }

    private function check()
    {
        if (is_null($this->root)) throw new Exception\NotLoadedException();
    }

    public function getId()
    {
        $this->check();
        return $this->root->getOptionalInteger('id');
    }

    public function getKey()
    {
        $id = $this->getId();
        //  We don't return a key when ID is non-null because
        //  in that case the ID is being used to locate the Form
        //  entity and the key is being updated
        if (!is_null($id)) return null;
        return $this->root->getString('key');
    }

    private function update(\Fgms\PartnerStoreBundle\Entity\Form $form)
    {
        //  TODO: Implement
        throw new \LogicException('Unimplemented');
        return $form;
    }

    private function getParams(\Fgms\ValueWrapper\ValueWrapper $wrapper)
    {
        $retr = $wrapper->getOptionalObject('params');
        if (is_null($retr)) return new \stdClass();
        return $retr->unwrap();
    }

    private function createField(\Fgms\ValueWrapper\ValueWrapper $wrapper, \Fgms\PartnerStoreBundle\Entity\Form $form)
    {
        $retr = new \Fgms\PartnerStoreBundle\Entity\Field();
        $retr->setForm($form)
            ->setType($wrapper->getString('type'))
            ->setRenderOrder(count($form->getFields()) + 1);
        $form->addField($retr);
        $retr->setParams($this->getParams($wrapper));
        //var_dump($retr);
        return $retr;   //  This value is unused currently
    }

    private function createFields(\Fgms\PartnerStoreBundle\Entity\Form $form)
    {
        $fields = $this->root->getOptionalArray('fields');
        if (is_null($fields)) return;
        $order = 0;
        foreach ($fields as $field) $this->createField($field,$form);
    }

    private function create()
    {
        $retr = new \Fgms\PartnerStoreBundle\Entity\Form();
        $retr->setKey($this->root->getString('key'))
            ->setParams($this->getParams($this->root));
        $this->createFields($retr);
        return $retr;
    }

    public function execute(\Fgms\PartnerStoreBundle\Entity\Form $form = null)
    {
        $this->check();
        $this->checkExecute($form);
        if (!is_null($form)) return $this->update($form);
        return $this->create();
    }
}
