<?php

namespace App\Form;

use App\Entity\Formateur;
use App\Entity\Formation;
use App\Entity\Session;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateDebut')
            ->add('dateFin')
            ->add('lieu')
            ->add('nombreMinParticipants')
            ->add('statut')
            ->add('formation', EntityType::class, [
                'class' => Formation::class,
                'choice_label' => 'id',
            ])
            ->add('formateur', EntityType::class, [
                'class' => Formateur::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}
