<?php

namespace App\Form;

use App\Entity\Inscription;
use App\Entity\Session;
use App\Entity\Stagiaire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateInscription', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date d’inscription',
            ])
            ->add('session', EntityType::class, [
                'class' => Session::class,
                'choice_label' => 'nom',
                'placeholder' => 'Choisir une session',
            ])
            ->add('stagiaire', EntityType::class, [
                'class' => Stagiaire::class,
                'choice_label' => function($stagiaire) {
                    return $stagiaire->getNom() . ' ' . $stagiaire->getPrenom();
                },
                'placeholder' => 'Choisir un stagiaire',
            ])
            ->add('coordonneesEntreprise', TextType::class, [
                'required' => false,
                'label' => 'Coordonnées de l’entreprise',
            ])
            // Ajoute d'autres champs nécessaires ici
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
