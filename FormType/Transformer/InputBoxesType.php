<?php

namespace Smada\SymfonyTypeExtrasBundle\FormType\Transformer;

use Doctrine\Common\Persistence\ObjectManager;
use Smada\SymfonyTypeExtrasBundle\Transformer\InputBoxesToStringTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InputBoxesType extends AbstractType
{
    /** @var ObjectManager */
    private $om;

    /** @param ObjectManager $om */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $boxes = intval($options['boxes']);

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($options, $boxes)
        {
            $form = $event->getForm();
            $data = $event->getData();

            $parts = null;
            if (!empty($data))
                $parts = str_split($data);

            $inputs = [];
            for ($i = 0; $i < $boxes; $i++)
                $inputs[] = [];

            if ($parts)
            {
                foreach ($inputs as $key => &$input)
                    if (isset($parts[$key]))
                        $input = ['input' => $parts[$key]];
            }

            $form->add("inputs", 'collection', [
                'type' => new InputBoxesSingleBoxType(),
                'label' => false,
                'data' => $inputs
            ]);
        });

        $builder->addModelTransformer(new InputBoxesToStringTransformer($this->om));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'invalid_message' => 'You must complete all the boxes',
            'boxes' => 5,
            'compound' => true
        ));
    }

    public function getParent()
    {
        return 'text';
    }

    public function getName()
    {
        return 'input_boxes';
    }
}
