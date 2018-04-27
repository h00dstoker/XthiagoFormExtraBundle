<?php

namespace Xthiago\FormExtraBundle\Form\Type;

use Xthiago\FormExtraBundle\Form\Type\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormView\FormInterface;


class SelectType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'multiple' => false,
                'allowcreate' => false,
                'placeholder' => null,
                'extrainfo' => null,
                'choices' => null,
                'minimumInputLength' => 0,
                'allowclear' => true,
            )
        );
    }

    public function buildView(\Symfony\Component\Form\FormView $view, \Symfony\Component\Form\FormInterface $form, array $options)
    {
        $view->vars['allowclear'] = array_key_exists('allowclear', $options) ? $options['allowclear'] : true;
        $view->vars['multiple'] = array_key_exists('multiple', $options) ? $options['multiple'] : null;
        $view->vars['allowcreate'] = array_key_exists('allowcreate', $options) ? $options['allowcreate'] : null;
        $view->vars['placeholder'] = array_key_exists('placeholder', $options) ? $options['placeholder'] : null;
        $view->vars['extrainfo'] = array_key_exists('extrainfo', $options) ? $options['extrainfo'] : null;
        $view->vars['choices'] = array_key_exists('choices', $options) ? $options['choices'] : null;
        $view->vars['minimumInputLength'] = array_key_exists('minimumInputLength', $options) ? $options['minimumInputLength'] : null;
    }

    public function getParent()
    {
        return 'text';
    }

    public function getBlockPrefix()
    {
        return 'xthiago_select';
    }
}