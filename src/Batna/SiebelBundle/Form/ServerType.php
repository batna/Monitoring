<?php

namespace Batna\SiebelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ServerType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('fullName')
            ->add('enableState')
            ->add('objectId')
            ->add('version')
            ->add('eventLog')
            //->add('parameters')
            //->add('attributes')
            ->add('host')
            ->add('enterprise')
            
        ;
    }

    public function getName()
    {
        return 'batna_siebelbundle_servertype';
    }
}
