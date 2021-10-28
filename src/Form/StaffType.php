<?php

namespace App\Form;

use App\Entity\Admin;
use App\Entity\Staff;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class StaffType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name', TextType::class, 
        [
            'label' => "Staff Name",
            'required' => true
        ])
        ->add('dob', DateType::class,
        [
            'label' => "dob",
            'required' => true,
            'widget' => 'single_text'
        ])
        ->add('nationality', ChoiceType::class,
        [
            'label' => "Nationality",
            'required' => true,
            'choices' => [
                "Vietnam" => "Vietnam",
                "Singapore" => "Singapore",
                "Japan" => "Japan",
                "Korea" => "Korea",
                "United States" => "United States"
            ]
        ])
        ->add('phone', IntegerType::class,
        [
            'label' => "Number Phone",
            'required' => true
        ])

        ->add('admstaff', EntityType::class,
        [
            'label' => "Admin",
            'class' => Admin::class,
            'choice_label' => "name",
            'multiple' => false,
            'expanded' => false
        ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Staff::class,
        ]);
    }
}
