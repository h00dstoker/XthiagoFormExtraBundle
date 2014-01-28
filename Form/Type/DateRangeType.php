<?php 

namespace Xthiago\FormExtraBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormView\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer;


class DateRangeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('from', 'xthiago_datetime', 
                array(
                    'format' => $options['format'],
                    'label' => 'de',
                    'required' => false,
                    'returnDatetime' => $options['returnDatetime'],
                    'dateType' => $options['dateType'],
                    'datepicker' => $options['datepicker'],
                )
            )
            ->add('to', 'xthiago_datetime', 
                array(
                    'format' => $options['format'],
                    'label' => 'até',
                    'required' => false,
                    'returnDatetime' => $options['returnDatetime'],
                    'dateType' => $options['dateType'],
                    'datepicker' => $options['datepicker'],
                )
            )
        ;
        /*if($options['retornar_datetime'] === true) {

            //$transformer = new DatetimeToStringTransformer($options['format']);
            $transformer = new DateTimeToStringTransformer(null, null, $options['format']);
            $builder->addModelTransformer($transformer);
        }*/
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'format' => 'd/m/Y', // formato das datas
                'dateType' => 'date',
                'compound' => true,

                'returnDatetime' => true,

                'onchange' => null,
                'datepicker' => true, // false para desabilitar o datepicker nos campos
            )
        );
    }

    protected function convertFormatToJavascriptDate($formato)
    {
        $padroes = // key: php - value: javascript
            array(
                'y' => 'yy',
                'Y' => 'yyyy',
                'm' => 'mm', 
                'd' => 'dd',
                'H' => 'hh',
                'i' => 'ii',
                's' => 'ss',
            )
        ;

        return str_replace(array_keys($padroes), array_values($padroes), $formato);
    }

    public function buildView(\Symfony\Component\Form\FormView $view, \Symfony\Component\Form\FormInterface $form, array $options)
    {
        $formato = array_key_exists('format', $options) ? $options['format'] : 'd/m/Y H:i:s';
        $view->vars['format'] = $this->convertFormatToJavascriptDate($formato);

        $view->vars['dateType'] = array_key_exists('dateType', $options) ? $options['dateType'] : 'date';

        $view->vars['datepicker'] = array_key_exists('datepicker', $options) ? $options['datepicker'] : true;
    }

    public function getParent()
    {
        return 'text';
    }

    public function getName()
    {
        return 'xthiago_daterange';
    }
}