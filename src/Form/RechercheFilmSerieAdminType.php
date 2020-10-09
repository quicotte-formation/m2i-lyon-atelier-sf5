<?php

namespace App\Form;

use App\DTO\RechercheFilmSerieAdminDTO;
use App\Entity\Genre;
use App\Entity\Pays;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheFilmSerieAdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('genre', EntityType::class, ['class'=>Genre::class, 'required'=>false])
            ->add('pays', EntityType::class, ['class'=>Pays::class, 'required'=>false])
            ->add('Rechercher', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RechercheFilmSerieAdminDTO::class,
        ]);
    }
}
