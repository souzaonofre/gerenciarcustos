<?php

namespace App\Form;

use App\Entity\Funcionario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FuncionarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $widgets_attrs = array('class' => 'form-control');

        $builder
            ->add('nome', null, array('attr' => $widgets_attrs))
            ->add('email', null, array('attr' => $widgets_attrs))
            ->add('senha', null, array('attr' => $widgets_attrs))
            ->add('departamento', null, array('attr' => $widgets_attrs))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Funcionario::class,
        ]);
    }
}
