<?php

namespace App\DataFixtures;

use App\Entity\Staff;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class StaffFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++) {
            $staff = new Staff();
            $staff->setName("staff $i");
            $staff->setDob(\DateTime::createFromFormat('Y-m-d', '1999-06-28'));
            $staff->setPhone("12345689");
            $staff->setNationality("VietNam");
            $manager->persist($staff);
        }

        $manager->flush();
    }
}
