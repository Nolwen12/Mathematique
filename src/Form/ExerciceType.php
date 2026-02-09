<?php

namespace App\Form;

use App\Entity\Chapitre;
use App\Entity\Correction;
use App\Entity\Exercice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ExerciceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('contenue', FileType::class, [
                'label' => 'Contenue (PDF file)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new Assert\File(
                        maxSize: '1024k',
                        extensions: ['pdf', 'doc'],
                        extensionsMessage: 'S il vous plaît télécharcher un PDF ou un document',
                    )
                ],
            ])
            ->add('date')
            ->add('correction', EntityType::class, [
                'class' => Correction::class,
                'choice_label' => 'name',
                'label' => 'Correction',
                'placeholder' => 'Choisir la correction de l exercice',
            ])
            ->add('chapitre', EntityType::class, [
                'class' => Chapitre::class,
                'choice_label' => 'title',
                'label' => 'Chapitre',
                'placeholder' => 'Choisir le chapitre de l exercice',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Exercice::class,
        ]);
    }
}
