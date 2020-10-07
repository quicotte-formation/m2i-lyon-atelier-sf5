<?php

namespace App\Form;

use App\DTO\FilmEtLiensDTO;
use App\Entity\Genre;
use App\Entity\Pays;
use App\Entity\Personne;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilmEtLiensType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('annee', IntegerType::class,
                [
                    'attr' => [
                        'min' => '1900',
                        'max' => '2020'
                    ],
                    'data' => '2020'

                ])
            ->add('duree', IntegerType::class, [
                'data'=>90,
                'attr'=>
                [
                    'min'=>1,
                    'max'=>360
                ]
            ])
            ->add('genre', EntityType::class, [
                'class'=>Genre::class,
            ])
            ->add('pays', EntityType::class, [
                'class'=>Pays::class,
            ])
            ->add('acteurs', EntityType::class, ['class'=>Personne::class, 'multiple'=>true])
            ->add('realisateurs', EntityType::class, ['class'=>Personne::class, 'multiple'=>true])
            ->add('nbLiens', IntegerType::class, [
                'data'=>1,
                'attr'=>
                [
                    'min'=>0,
                    'max'=>10
                ]
            ])
            ->add('Ajouter', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FilmEtLiensDTO::class,
        ]);
    }
}
