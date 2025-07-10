<?php

namespace App\Form;

use App\Entity\TestPrerequis;
use App\Entity\Formation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TestPrerequisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class)
            ->add('description', TextareaType::class, ['required' => false])
            ->add('nbQuestions', IntegerType::class)
            ->add('formation', EntityType::class, [
                'class' => Formation::class,
                'choice_label' => 'nom',
                'placeholder' => 'Choisir une formation',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TestPrerequis::class,
        ]);
    }
}
