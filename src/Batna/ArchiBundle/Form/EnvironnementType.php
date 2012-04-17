<?php

namespace Batna\ArchiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class EnvironnementType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('shortName')
            ->add('longName')
            ->add('description')
            ->add('contexte')
        ;
    }

    public function getName()
    {
        return 'batna_archibundle_environnementtype';
    }
}
