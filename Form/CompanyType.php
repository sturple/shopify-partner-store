<?php

namespace Fgms\PartnerStoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompanyType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('status',\Symfony\Component\Form\Extension\Core\Type\ChoiceType::class,array('choices' => array('Active'=>'active',
                                                        'Disable'=>'disable',
                                                        'Delete'=>'delete')))
        ->add('title')
        ->add('summary', null, array('required'=>false))
        ->add('template', null, array('required'=>false))
        ->add('permalink', null, array('required'=>false))
        ->add('company', null, array('required'=>false))
        ->add('firstName', null, array('required'=>false))
        ->add('lastName', null, array('required'=>false))
        ->add('phone', null, array('required'=>false))
        ->add('phoneToll', null, array('required'=>false))
        ->add('phoneFax', null, array('required'=>false))
        ->add('phoneCell', null, array('required'=>false))
        ->add('email', null, array('required'=>false))
        ->add('address1', null, array('required'=>false))
        ->add('address2', null, array('required'=>false))
        ->add('city', null, array('required'=>false))
        ->add('province', null, array('required'=>false))
        ->add('postal', null, array('required'=>false))
        ->add('country', null, array('required'=>false))
        ->add('save',\Symfony\Component\Form\Extension\Core\Type\SubmitType::class,array('label'=>'Save'))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Fgms\PartnerStoreBundle\Entity\Company'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'fgms_partnerstorebundle_company';
    }


}
