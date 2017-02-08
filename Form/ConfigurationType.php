<?php

namespace Fgms\PartnerStoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConfigurationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('status')->add('createDate')->add('updateDate')->add('title')->add('summary')->add('template')->add('permalink')->add('company')->add('firstName')->add('lastName')->add('phone')->add('phoneToll')->add('phoneFax')->add('phoneCell')->add('email')->add('address1')->add('address2')->add('city')->add('province')->add('postal')->add('country')->add('store')        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Fgms\PartnerStoreBundle\Entity\Configuration'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'fgms_partnerstorebundle_configuration';
    }


}
