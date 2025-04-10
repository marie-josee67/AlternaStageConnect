<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture
{
    // instanciation de symfony comme un service
    // crécupération du service de hachage de mot de passe
    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasher
    )
    {
        
    }
    
    /* ********************************** création d'utilisateur ***************************************************  */
    public function load(ObjectManager $manager, ): void
    {
        $nbUsers = 5;
        $faker = Factory::create('fr_FR');

        // utilisateur 1 
        $user = new User();
        $user->setEmail("Prubis@app.fr")
            ->setFirstname("Plume")
            ->setLastname('Rubis');
        $user->setPassword($this->userPasswordHasher->hashPassword($user, "qsdfghjklm123456/"));
        $manager->persist($user);

        // utilisateur 2 
        $user = new User();
        $user->setEmail("developpeuse@outlook.fr")
            ->setFirstname("Marie-josée")
            ->setLastname('Schmitt');
        $user->setPassword($this->userPasswordHasher->hashPassword($user, "azertyuiop123456/"));
        $manager->persist($user);

        // utilisateur de masse 
        for($i = 0; $i < $nbUsers; $i++){
            $user = new User();
        $user->setEmail($faker->email())
            ->setFirstname($faker->firstName())
            ->setLastname($faker->lastName());

        $user->setPassword($this->userPasswordHasher->hashPassword($user, $faker->password()));
        $manager->persist($user);
        }
      
        $manager->flush();
    }
}
