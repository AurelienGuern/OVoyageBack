<?php

namespace App\Form;

use App\Entity\Activity;
use App\Entity\City;
use App\Entity\Tag;
use App\Entity\Trip;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActivityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('date')
            ->add('postalAddress')
            ->add('price')
            ->add('openingTimeAndDays')
            ->add('score')
            ->add('city', EntityType::class, [
                'class' => City::class,
'choice_label' => 'id',
            ])
            ->add('trip', EntityType::class, [
                'class' => Trip::class,
'choice_label' => 'id',
            ])
            ->add('creator', EntityType::class, [
                'class' => User::class,
'choice_label' => 'id',
            ])
            ->add('tags', EntityType::class, [
                'class' => Tag::class,
'choice_label' => 'id',
'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Activity::class,
        ]);
    }
}
