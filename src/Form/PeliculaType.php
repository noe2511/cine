<?php

namespace App\Form;

use App\Entity\Pelicula;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PeliculaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('director')
            ->add('fechaEstreno')
            ->add('duracion')
            ->add('descripcion')
            ->add('actores')
            ->add('imagen')
            ->add('titulo')
            ->add('trailer')
            ->add('generoIdgenero')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pelicula::class,
        ]);
    }
}
