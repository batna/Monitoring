<?php

namespace Batna\SiebelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ComponentGroupType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('fullName')
            ->add('description')
            ->add('enableState')
            ->add('objectId')
        ;
    }

    public function getName()
    {
        return 'batna_siebelbundle_componentgrouptype';
    }
}
