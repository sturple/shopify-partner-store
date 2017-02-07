<?php

namespace Fgms\PartnerStoreBundle\Tests\Configuration;

class ValueWrapperConfigurationTest extends \PHPUnit_Framework_TestCase
{
    private function create($obj = null)
    {
        return new \Fgms\PartnerStoreBundle\Configuration\MockValueWrapperConfiguration(
            is_null($obj) ? null : new \Fgms\ValueWrapper\ValueWrapperImpl($obj)
        );
    }

    public function testGetKey()
    {
        $config = $this->create((object)['key' => 'foo']);
        $this->assertSame('foo',$config->getKey());
    }

    public function testGetKeyNull()
    {
        $config = $this->create((object)['key' => 'bar','id' => 5]);
        $this->assertNull($config->getKey());
    }

    public function testGetKeyInvalid()
    {
        $config = $this->create();
        $this->expectException(\Fgms\PartnerStoreBundle\Configuration\Exception\NotLoadedException::class);
        $config->getKey();
    }

    public function testExecuteInvalidNoForm()
    {
        $config = $this->create((object)['id' => 5,'key' => 'foo']);
        $this->expectException(\Fgms\PartnerStoreBundle\Configuration\Exception\InvalidExecuteException::class);
        $config->execute(null);
    }

    public function testExecuteInvalidId()
    {
        $config = $this->create((object)['id' => 5,'key' => 'foo']);
        $form = new \Fgms\PartnerStoreBundle\Entity\Form();
        $rc = new \ReflectionClass($form);
        $prop = $rc->getProperty('id');
        $prop->setAccessible(true);
        $prop->setValue($form,4);
        $this->expectException(\Fgms\PartnerStoreBundle\Configuration\Exception\InvalidExecuteException::class);
        $config->execute($form);
    }

    public function testExecuteInvalidKey()
    {
        $config = $this->create((object)['key' => 'foo']);
        $form = new \Fgms\PartnerStoreBundle\Entity\Form();
        $form->setKey('bar');
        $this->expectException(\Fgms\PartnerStoreBundle\Configuration\Exception\InvalidExecuteException::class);
        $config->execute($form);
    }

    public function testExecuteCreate()
    {
        $config = $this->create((object)[
            'key' => 'foo',
            'params' => (object)[
                'param' => 5
            ],
            'fields' => [
                (object)[
                    'type' => 'bar'
                ],
                (object)[
                    'type' => 'baz',
                    'params' => (object)[
                        'test' => 'quux'
                    ]
                ]
            ]
        ]);
        $form = $config->execute(null);
        $this->assertNull($form->getId());
        $this->assertSame('foo',$form->getKey());
        $params = $form->getParams()->unwrap();
        $vars = get_object_vars($params);
        $this->assertCount(1,$vars);
        $this->assertArrayHasKey('param',$vars);
        $this->assertSame(5,$vars['param']);
        $fields = $form->getFields();
        $this->assertCount(2,$fields);
        $field = $fields[0];
        $this->assertSame($form,$field->getForm());
        $this->assertSame('bar',$field->getType());
        $this->assertSame(1,$field->getRenderOrder());
        $this->assertCount(0,$field->getFieldSubmissions());
        $fparams = $field->getParams()->unwrap();
        $this->assertCount(0,get_object_vars($fparams));
        $field = $fields[1];
        $this->assertSame($form,$field->getForm());
        $this->assertSame('baz',$field->getType());
        $this->assertSame(2,$field->getRenderOrder());
        $this->assertCount(0,$field->getFieldSubmissions());
        $fparams = $field->getParams()->unwrap();
        $fvars = get_object_vars($fparams);
        $this->assertCount(1,$fvars);
        $this->assertArrayHasKey('test',$fvars);
        $this->assertSame('quux',$fvars['test']);
    }

    public function testExecuteUpdate()
    {
        $config = $this->create((object)[
            'key' => 'foo'
        ]);
        $form = new \Fgms\PartnerStoreBundle\Entity\Form();
        $form->setKey('foo');
        //  TODO: Remove this once update logic is implemented
        $this->expectException(\LogicException::class);
        $retr = $config->execute($form);
        //  This code is currently unreachable: The above invocation
        //  always throws...
        $this->assertSame($form,$retr);
    }
}
