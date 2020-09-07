<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class UserFixture extends Fixture
{
	private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('abd1@symfony.com');
        $user->setRoles(['ROLE_ADMIN']);
        
        
        $user->setPassword($this->passwordEncoder->encodePassword(
             $user,
             '123'
         ));

		$manager->persist($user);
        $manager->flush();
    }
}
