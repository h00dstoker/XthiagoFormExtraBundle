<?php 

namespace Xthiago\FormExtraBundle\Form\Type;

use Xthiago\FormExtraBundle\Form\Type\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormView\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer;


class DatetimeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if($options['returnDatetime'] === true) {

            //$transformer = new DatetimeToStringTransformer($options['format']);
            $transformer = new DateTimeToStringTransformer(null, null, $options['format']);
            $builder->addModelTransformer($transformer);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'format' => 'd/m/Y', // formato da data (exemplo: d/m/Y H:i)
                'autoclose' => true, // fecha a picker ao selecionar data
                'todayBtn' => true, // mostra botão 'hoje'
                'startDate' => null, // primeira data que pode ser selecionada (deve estar no mesmo formato de 'format') - ex: '05/11/2013 00:00'
                'endDate' => null, // última data que pode ser selecionada (deve estar no mesmo formato de 'format') - ex: '15/11/2013 23:59'
                'minuteStep' => 30, // incremento usado para exibir a seleção de minutos
                'language' => 'pt-BR', // idioma do picker
                'startView' => null, // janela que aparece quando o datepicker é aberto
                'minView' => 2, // última janela a ser exibida para concluir a seleção (0 -minutos,  1-hora, 2 - dias, 3 - meses, 4- anos)
                'maxView' => null, 
                'todayHighlight' => true, // destaca o dia atual na listagem de dias
                'keyboardNavigation' => true, // permite navegar pelo teclado
                'daysOfWeekDisabled' => null, // dias da semana que devem ser desabilitado (ex: '0,6')
                'weekStart' => 0, // primeiro dia da semana

                'returnDatetime' => true, // true para retornar \DateTime e false para string

                'dateType' => 'date', // tipos possíveis: date (d/m/Y), datetime (d/m/Y H:i), month (m/Y), year (Y)

                'onchange' => null,
                'datepicker' => true, // false para desabilitar o datepicker
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
        /*if($options['format'] === null) {

            $type = $options['type'];

            if($type == 'date') {

                $options['format'] = 'd/m/Y';
                $options['minView'] = 2;

            } else if($type == 'datetime') {

                $options['format'] = 'd/m/Y H:i';
                $options['minView'] = 0;

            } else if($type == 'month') {

                $options['format'] = 'm/Y';
                $options['minView'] = 3;
                $options['startView'] = 3;

            } else if($type == 'year') {

                $options['format'] = 'Y';
                $options['minView'] = 4;
                $options['startView'] = 4;            

            }
        }*/

        $formato = array_key_exists('format', $options) ? $options['format'] : 'd/m/Y H:i:s';
        $view->vars['format'] = $this->convertFormatToJavascriptDate($formato);

        $view->vars['readonly'] = array_key_exists('readonly', $options) ? $options['readonly'] : null;
        $view->vars['autoclose'] = array_key_exists('autoclose', $options) ? $options['autoclose'] : null;
        $view->vars['todayBtn'] = array_key_exists('todayBtn', $options) ? $options['todayBtn'] : null;
        $view->vars['startDate'] = array_key_exists('startDate', $options) ? $options['startDate'] : null;
        $view->vars['endDate'] = array_key_exists('endDate', $options) ? $options['endDate'] : null;
        $view->vars['minuteStep'] = array_key_exists('minuteStep', $options) ? $options['minuteStep'] : null;
        $view->vars['language'] = array_key_exists('language', $options) ? $options['language'] : null;
        $view->vars['minView'] = array_key_exists('minView', $options) ? $options['minView'] : null;
        $view->vars['maxView'] = array_key_exists('maxView', $options) ? $options['maxView'] : null;
        $view->vars['todayHighlight'] = array_key_exists('todayHighlight', $options) ? $options['todayHighlight'] : null;
        $view->vars['keyboardNavigation'] = array_key_exists('keyboardNavigation', $options) ? $options['keyboardNavigation'] : null;
        $view->vars['daysOfWeekDisabled'] = array_key_exists('daysOfWeekDisabled', $options) ? $options['daysOfWeekDisabled'] : null;
        $view->vars['weekStart'] = array_key_exists('weekStart', $options) ? $options['weekStart'] : null;
        $view->vars['startView'] = array_key_exists('startView', $options) ? $options['startView'] : null;

        $view->vars['onchange'] = array_key_exists('onchange', $options) ? $options['onchange'] : null;

        $view->vars['dateType'] = array_key_exists('dateType', $options) ? $options['dateType'] : 'date';

        $view->vars['datepicker'] = array_key_exists('datepicker', $options) ? $options['datepicker'] : true;
    }

    public function getParent()
    {
        return \Symfony\Component\Form\Extension\Core\Type\TextType::class;
    }

    public function getBlockPrefix()
    {
        return 'xthiago_datetime';
    }
}