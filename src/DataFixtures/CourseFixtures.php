<?php

namespace App\DataFixtures;

use App\Entity\Course;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CourseFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++) {
            $course = new Course();
            $course->setName("course $i");
            $course->setCategory("IT");
            $course->setDisplay("devenlop skill");
            $manager->persist($course);
        }
        $manager->flush();
    }
}
