<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Validator\Constraints\DateTime;

class AdminFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++) {
            $author = new Admin();
            $author->setName("Author $i");
            $author->setDob(\DateTime::createFromFormat('Y-m-d', '1999-06-28'));
            $author->setNationality("VietNam");
            $author->setPhone("123");
            $author->setAvatar("avatar.png");
            $manager->persist($author);
        }

        $manager->flush();
    }
}
