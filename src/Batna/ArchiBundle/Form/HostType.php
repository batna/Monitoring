<?php

namespace Batna\ArchiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class HostType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('hostname')
            ->add('ip')
            ->add('ram')
            ->add('cpuCore')
            ->add('cpuFrequency')
            ->add('isPhysical')
            ->add('os')
        ;
    }

    public function getName()
    {
        return 'batna_archibundle_hosttype';
    }
}
