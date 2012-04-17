<?php

namespace Batna\AlerteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class SeuilType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('debut')
            ->add('fin')
            ->add('unite')
            ->add('severite')
            ->add('titre')
            ->add('message')
            ->add('variables')
            ->add('categorie')
            ->add('diffusion')
        ;
    }

    public function getName()
    {
        return 'batna_alertebundle_seuiltype';
    }
}
