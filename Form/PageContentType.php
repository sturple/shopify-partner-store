<?php

namespace Fgms\PartnerStoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PageContentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('updateDate')->add('title')->add('subtitle')->add('imageLogo')->add('guidLogo')->add('guidFeatureImage')->add('guidBackgroundImage')->add('content')->add('shopUrl')->add('shopEmail')->add('promoCode')->add('collectionFeature')->add('collectionPartner')->add('collectionOther')->add('css')->add('store')        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Fgms\PartnerStoreBundle\Entity\PageContent'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'fgms_partnerstorebundle_pagecontent';
    }


}
