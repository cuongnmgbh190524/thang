<?php

namespace App\Form;

use App\Entity\Student;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name', TextType::class, 
        [
            'label' => "Student Name",
            'required' => true
        ])
        ->add('age', IntegerType::class,
        [
            'label' => "Age",
            'required' => true,
        ])
        ->add('phone', IntegerType::class,
        [
            'label' => "Number Phone",
            'required' => true
        ])
        ->add('email', TextType::class, 
        [
            'label' => "Student Email",
            'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
