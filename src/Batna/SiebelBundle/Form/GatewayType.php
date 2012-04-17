<?php

namespace Batna\SiebelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class GatewayType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('port')
            ->add('host')
            ->add('environnement')
            ->add('version')
            ->add('name')
            ->add('description')
            ->add('fullName')
            ->add('enableState')
            ->add('objectId')
            ->add('createDefault')
            ->add('useDefault')
           	->add('currentFile', 'file');
            ;
    }

    public function getName()
    {
        return 'batna_siebelbundle_gatewaytype';
    }
}
