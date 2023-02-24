<?php

namespace App\DataFixtures;

use App\DataFixtures\Abstr\CoreFixture;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends CoreFixture
{

  private $passwordHasher;


  public function __construct(UserPasswordHasherInterface $passwordHasher)
  {
    parent::__construct();

    $this->passwordHasher = $passwordHasher;
  }

  protected function loadFakeData(): void
  {
    $usersData = $this->faker->getUsers();

    foreach ($usersData as $username => $userData) {
      $user = new User();

      $user->setEmail($userData['email']);
      // $user->setUsername($username);
      $user->setRoles($userData['roles']);
      $user->setPassword($this->passwordHasher->hashPassword($user, $userData['password']));
      $user->setIsActive(true);
      $user->setCreatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTime()));

      $this->manager->persist($user);
    }
    $this->manager->flush();
  }
}
