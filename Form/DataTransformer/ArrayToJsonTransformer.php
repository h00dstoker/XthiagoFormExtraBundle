<?php

namespace Xthiago\FormExtraBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Transforms between a JSON string and an associative array.
 *
 * @author Thiago Rodrigues <xthiago@gmail.com>
 */
class ArrayToJsonTransformer implements DataTransformerInterface
{
    /**
     * Constructor
     *
     */
    public function __construct()
    {
    }

    /**
     * Transforms an array into a JSON string
     *
     * @param array $array Array to transform
     *
     * @return string
     *
     * @throws TransformationFailedException If the given value is not an array
     */
    public function transform($array)
    {
        if (null === $array) {
            return '';
        }

        if (!is_array($array)) {
            throw new TransformationFailedException('Expected an array.');
        }

        $string = json_encode($array);

        return $string;
    }

    /**
     * Transforms a JSON string into an array
     *
     * @param string $string String to transform
     *
     * @return array
     *
     * @throws TransformationFailedException If the given value is not a string
     */
    public function reverseTransform($string)
    {
        if (null !== $string && !is_string($string)) {
            throw new TransformationFailedException('Expected a string.');
        }

        if (empty($string)) {
            return array();
        }

        $values = json_decode($string, true);

        if (0 === count($values)) {
            return array();
        }

        return $values;
    }
}
