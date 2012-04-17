<?php

namespace Batna\AlerteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class AlerteType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('date')
            ->add('valeurs')
            //->add('estDiffusee')
            ->add('seuil')
        ;
    }

    public function getName()
    {
        return 'batna_alertebundle_alertetype';
    }
}
