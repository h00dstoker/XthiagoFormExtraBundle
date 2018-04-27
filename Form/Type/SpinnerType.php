<?php 

namespace Xthiago\FormExtraBundle\Form\Type;

use Xthiago\FormExtraBundle\Form\Type\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormView\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer;


class SpinnerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'label' => false,
                //'styleType' => '2', // em pt é: 2 e 7.
            )
        );
    }

    public function buildView(\Symfony\Component\Form\FormView $view, \Symfony\Component\Form\FormInterface $form, array $options)
    {
        //$view->vars['styleType'] = array_key_exists('styleType', $options) ? $options['styleType'] : '2';

        parent::buildView($view, $form, $options);
    }

    public function getParent()
    {
        return \Symfony\Component\Form\Extension\Core\Type\TextType::class;
    }

    public function getBlockPrefix()
    {
        return 'xthiago_spinner';
    }
}