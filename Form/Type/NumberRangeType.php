<?php

namespace Xthiago\FormExtraBundle\Form\Type;

use Xthiago\FormExtraBundle\Form\Type\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
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

    public function configureOptions(OptionsResolver $resolver)
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
        return \Symfony\Component\Form\Extension\Core\Type\TextType::class;
    }

    public function getBlockPrefix()
    {
        return 'xthiago_numberrange';
    }
}