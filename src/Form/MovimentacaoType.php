<?php

namespace App\Form;

use App\Entity\Movimentacao;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class MovimentacaoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $date_widget_attrs = array('class' => 'form-group');

        $widgets_attrs = array('class' => 'form-control');

        $builder
            ->add('data', DateType::class, array('attr' => $date_widget_attrs, 'format' => 'dd-MM-yyyy'))
            ->add('fornecedor', null, array('attr' => $widgets_attrs))
            ->add('descricao', null, array('attr' => $widgets_attrs))
            ->add('valor', null, array('attr' => $widgets_attrs))
            ->add('funcionario', null, array('attr' => $widgets_attrs))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Movimentacao::class,
        ]);
    }
}
