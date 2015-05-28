<?php

namespace Smada\SymfonyTypeExtrasBundle\Transformer;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;

class InputBoxesToStringTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager $om
     */
    private $om;

    /** @param ObjectManager $om */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    public function transform($value)
    {
        return str_split($value);
    }
    public function reverseTransform($value)
    {
        $result = "";
        foreach ($value['inputs'] as $input)
            $result .= $input['input'];

        return $result;
    }

} 