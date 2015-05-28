<?php

namespace Smada\SymfonyTypeExtrasBundle\FormType\Transformer;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class InputBoxesSingleBoxType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('input', null, ['label' => false, 'attr' => ['maxlength' => 1]]);
    }

    public function getName()
    {
        return 'input_boxes_single_box';
    }
}
