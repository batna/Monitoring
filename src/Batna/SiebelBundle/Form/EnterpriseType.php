<?php

namespace Batna\SiebelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class EnterpriseType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('fullName')
            ->add('description')
            ->add('signature')
            ->add('enableState')
            ->add('objectId')
            ->add('version')
            ->add('databasePlatform')
            ->add('useMSStored')
            ->add('attrDescription')
            ->add('databaseConStr')
            ->add('serverSequence')
            ->add('componentGroupSequence')
            ->add('componentSequence')
            ->add('namedSubsystemSequence')
            //->add('parameters')
            //->add('components')
            ->add('gateway')
        ;
    }

    public function getName()
    {
        return 'batna_siebelbundle_enterprisetype';
    }
}
