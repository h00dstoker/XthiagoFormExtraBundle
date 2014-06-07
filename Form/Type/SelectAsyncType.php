<?php

namespace Xthiago\FormExtraBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormView\FormInterface;


class SelectAsyncType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'multiple' => false,
                'data_source_route' => null,
                'allowcreate' => false,
                'placeholder' => null,
                'extrainfo' => null,
                'beforeAjax' => null,
                'quietMillis' => 1000,
                'allowclear' => true, // somente funciona se um placeholder for especificado (limitação do Select2)
            )
        );
    }

    public function buildView(\Symfony\Component\Form\FormView $view, \Symfony\Component\Form\FormInterface $form, array $options)
    {
        $view->vars['allowclear'] = array_key_exists('allowclear', $options) ? $options['allowclear'] : true;
        $view->vars['data_source_route'] = array_key_exists('data_source_route', $options) ? $options['data_source_route'] : null;
        $view->vars['route_parameters'] = array_key_exists('route_parameters', $options) ? $options['route_parameters'] : null;
        $view->vars['multiple'] = array_key_exists('multiple', $options) ? $options['multiple'] : null;
        $view->vars['allowcreate'] = array_key_exists('allowcreate', $options) ? $options['allowcreate'] : null;
        $view->vars['placeholder'] = array_key_exists('placeholder', $options) ? $options['placeholder'] : null;
        $view->vars['extrainfo'] = array_key_exists('extrainfo', $options) ? $options['extrainfo'] : null;
        $view->vars['beforeAjax'] = array_key_exists('beforeAjax', $options) ? $options['beforeAjax'] : null;
        $view->vars['quietMillis'] = array_key_exists('quietMillis', $options) ? $options['quietMillis'] : null;
    }

    public function getParent()
    {
        return 'text';
    }

    public function getName()
    {
        return 'xthiago_select_async';
    }
}