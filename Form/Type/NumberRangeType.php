<?php

namespace Xthiago\FormExtraBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormView\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer;


class NumberRangeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('from', 'text',
                array(
                    'label' => 'de',
                    'required' => false
                )
            )
            ->add('to', 'text',
                array(
                    'label' => 'até',
                    'required' => false
                )
            )
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'compound' => true,
            )
        );
    }

    public function buildView(\Symfony\Component\Form\FormView $view, \Symfony\Component\Form\FormInterface $form, array $options)
    {
    }

    public function getParent()
    {
        return 'text';
    }

    public function getName()
    {
        return 'xthiago_numberrange';
    }
}