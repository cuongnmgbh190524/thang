<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $hasher;

    //khai báo interface để mã hóa mật khẩu
    public function __construct(UserPasswordHasherInterface $hasher) {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        //tạo tài khoản với role User
        $user = new User();
        $user->setUsername("user");
        $user->setPassword($this->hasher->hashPassword($user,"123456"));
        $user->setRoles(["ROLE_STUDENT"]);
        $manager->persist($user);

        //tạo tài khoản với role Manager
        $user = new User();
        $user->setUsername("staff");
        $user->setPassword($this->hasher->hashPassword($user,"123456"));
        $user->setRoles(["ROLE_STAFF"]);
        $manager->persist($user);

        //tạo tài khoản với role Admin
        $user = new User();
        $user->setUsername("admin");
        $user->setPassword($this->hasher->hashPassword($user,"123456"));
        $user->setRoles(["ROLE_ADMIN"]);
        $manager->persist($user);

        $manager->flush();
    }
}
