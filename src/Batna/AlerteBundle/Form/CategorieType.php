<?php

namespace Batna\AlerteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('type')
            ->add('libelle')
        ;
    }

    public function getName()
    {
        return 'batna_alertebundle_categorietype';
    }
}
