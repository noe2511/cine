<?php

namespace App\Form;

use App\Entity\Horario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HorarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('horainicio')
            ->add('fecha')
            ->add('peliculaIdpelicula')
            ->add('salaIdsala')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Horario::class,
        ]);
    }
}
