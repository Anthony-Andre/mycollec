<?php

namespace App\Form;

use App\Entity\Console;
use App\Entity\VideoGame;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class VideoGameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom Du Jeu'
            ])
            ->add('year', IntegerType::class, [
                'label' => 'Date De Sortie',
                'attr' => [
                    'placeholder' => '2022'
                ]
            ])
            ->add('console', EntityType::class, [
                'class' => Console::class,
                'choice_label' => 'name',
                'choice_value' => 'name',
                'label' => 'Plateforme',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer'
            ])
            // ->add('collecs')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VideoGame::class,
        ]);
    }
}
