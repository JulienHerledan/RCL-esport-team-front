<?php

namespace App\DataFixtures\Provider;

use Faker\Provider\Base;

class SocialNetworkProvider extends Base
{

  private $name = array(
    "Facebook",
    "Instagram",
    "Twitter",
    "Twitch",
    "Linkedin",
  );

  public function getSocialNetworkName(): string
  {
    return self::randomElement($this->name);
  }

}
