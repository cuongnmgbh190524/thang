<?php

namespace App\Form;

use App\Entity\Course;
use App\Entity\Student;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CourseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name', TextType::class, 
        [
            'label' => "Course Name",
            'required' => true
        ])

        ->add('category', ChoiceType::class,
        [
            'label' => "Category Course",
            'required' => true,
            'choices' => [
                "IT"=> "IT",
                "Databases"=> "Databases",
                "Php"=> "Php",
                "HTML"=> "HTML",
                "Bussiness" => "Bussiness",
            ]
        ])
        ->add('display', TextType::class, 
        [
            'label' => "Dispaly",
            'required' => true
        ])
        

        ->add('view', EntityType::class,
        [
            'label' => "Student",
            'class' => Student::class,
            'choice_label' => "name",
            'multiple' => true,
            'expanded' => false
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Course::class,
        ]);
    }
}
