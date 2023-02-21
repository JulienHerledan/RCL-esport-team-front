<?php

namespace App\DataFixtures\Provider;

use App\Entity\User;
use Faker\Provider\Base;

class UserProvider extends Base
{
  // Can't instantiate objects in a class property in php 7
  // So I have to use an array like this
  private $users = array(
    'admin' => [
      'email' => "admin@gmail.com",
      'roles' => ["ROLE_ADMIN"],
      'password' => "admin"
    ],
    'user' => [
      'email' => "user@gmail.com",
      'roles' => ["ROLE_USER"],
      'password' => "user"
    ],
  );

  public function getUsers(): array
  {
    return $this->users;
  }

}
