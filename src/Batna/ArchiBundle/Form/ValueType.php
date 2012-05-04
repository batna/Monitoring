<?php

namespace Batna\ArchiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ValueType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('value')
        ;
    }

    public function getName()
    {
        return 'batna_archibundle_valuetype';
    }
}
