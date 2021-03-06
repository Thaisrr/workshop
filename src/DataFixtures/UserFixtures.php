<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\Date;


class UserFixtures extends Fixture
{
    private $passEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }


public function load(ObjectManager $manager)
    {

         $user = new User();
         $user->setEmail('admin@workshop.com');
        $user->setPassword(
            $this->passwordEncoder->encodePassword(
                             $user,
                             'password'
        ));
        $user->setFirstname('Jean');
        $user->setLastname('Dupond');
        $date = new \DateTime();
        $user->setRoles(['ROLE_ADMIN']);

         $manager->persist($user);
        $manager->flush();
    }
}
