<?php

namespace App\DataFixtures\Provider;

use Faker\Provider\Base;

class GameProvider extends Base
{

  private $name = array(
    "Super Luigi",
    "Call Of Fofy",
    "Front Game",
    "Back Game",
    "Metal Slugy",
    "Street fixtures 2",
    "SpiderWomen",
    "Ligue Of Master",
    "PaddleVania",
    "Symfony Fantasy 7"
  );

  public function getGameName(): string
  {
    return self::randomElement($this->name);
  }

}
