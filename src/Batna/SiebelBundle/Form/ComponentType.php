<?php

namespace Batna\SiebelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ComponentType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('runMode')
            ->add('incarnationNumber')
            ->add('fullName')
            ->add('description')
            ->add('componentType')
            ->add('serviceType')
            ->add('enableState')
            ->add('objectId')
            ->add('writeFlag')
            ->add('configFile')
            ->add('dataSource')
            ->add('namedDataSource')
            ->add('lang')
            ->add('componentGroup')
        ;
    }

    public function getName()
    {
        return 'batna_siebelbundle_componenttype';
    }
}
