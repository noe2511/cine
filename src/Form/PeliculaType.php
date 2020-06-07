<?php

namespace App\Form;

use App\Entity\Pelicula;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TimezoneType;
use Symfony\Component\Validator\Constraints\File;

class PeliculaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo')
            ->add('descripcion', TextareaType::class)
            ->add('director')
            ->add('actores')
            ->add('generoIdgenero')
            ->add('fechaEstreno')
            ->add('duracion')
            ->add('imagen')
            ->add('imagen', FileType::class, [
                'label' => 'Imagen',
                'mapped' => false,
                'constraints' => [new File(['mimeTypes' =>
                ['image/png', 'image/jpeg', 'image/gif'], 'mimeTypesMessage' =>
                'Solo se permiten imágenes'])]
            ])

            ->add('trailer');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pelicula::class,
        ]);
    }
}
