<?php

namespace Batna\SiebelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class NamedSubsystemType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('fullName')
            ->add('description')
            ->add('enableState')
            ->add('subsystemName')
            ->add('objectId')
            ->add('enterprise')
            //->add('parameters')
        ;
    }

    public function getName()
    {
        return 'batna_siebelbundle_namedsubsystemtype';
    }
}
