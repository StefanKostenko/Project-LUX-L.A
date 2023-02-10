<?php

namespace App\Form;

use App\Entity\Entrada;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class EntradaFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, array('label' => 'Nombre'))
            ->add('dni', null, array('label' => 'DNI/NIE'))
            ->add('email', EmailType::class, array('label' => 'Correo'))
            ->add('date', TextType::class, array('mapped' => false,'label' => 'Fecha', ))
            ->add('num_personas', null, array('label' => 'Nº entradas'))
            ->add('Send', SubmitType::class, array('label' => 'Comprar'));
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Entrada::class,
        ]);
    }
}
