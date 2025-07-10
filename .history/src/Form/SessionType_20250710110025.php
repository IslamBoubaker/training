<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\Formation;
use App\Entity\Formateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lieu', TextType::class)
            ->add('dateDebut', DateTimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('dateFin', DateTimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('minimumParticipant', IntegerType::class)
            ->add('formation', EntityType::class, [
                'class' => Formation::class,
                'choice_label' => 'nom',
                'placeholder' => 'Choisir une formation',
            ])
            ->add('formateur', EntityType::class, [
                'class' => Formateur::class,
                'choice_label' => function($formateur) {
                    return $formateur->getNom() . ' ' . $formateur->getPrenom();
                },
                'placeholder' => 'Choisir un formateur',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}
