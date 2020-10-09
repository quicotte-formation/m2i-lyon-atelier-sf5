<?php

namespace App\Form;

use App\DTO\RechercheFilmSerieVisiteurDTO;
use App\Entity\Genre;
use App\Entity\Pays;
use App\Entity\Personne;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheFilmSerieVisiteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('genre', EntityType::class, ['required'=>false, 'class'=>Genre::class])
            ->add('pays', EntityType::class, ['required'=>false, 'class'=>Pays::class])
            ->add('acteur', EntityType::class, ['required'=>false, 'class'=>Personne::class])
            ->add('real', EntityType::class, ['required'=>false, 'class'=>Personne::class])
            ->add('annee', IntegerType::class,['required'=>false, 'attr'=>['min'=>1900, 'max'=>2020]])
            ->add('Rechercher', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RechercheFilmSerieVisiteurDTO::class,
        ]);
    }
}
