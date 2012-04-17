<?php

namespace Batna\AlerteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class DiffusionType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('groupes')
            ->add('users')
        ;
    }

    public function getName()
    {
        return 'batna_alertebundle_diffusiontype';
    }
}
