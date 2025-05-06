<?php

namespace App\Form;

use App\Entity\Intervention;
use App\Entity\Repartition;
use App\Entity\vehicule;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\{TextType,SubmitType};

class RepartitionTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('horodateur')
            ->add('vehicule', EntityType::class, [
                'class' => vehicule::class,
                'choice_label' => 'metricule',
            ])
            ->add('intervention', EntityType::class, [
                'class' => Intervention::class,
                'choice_label' => 'id',
            ])
            ->add('Creer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Repartition::class,
        ]);
    }
}
