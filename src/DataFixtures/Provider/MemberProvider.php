<?php

namespace App\DataFixtures\Provider;

use Faker\Provider\Base;

class MemberProvider extends Base
{

  private $photo = array(
    "https://imgur.com/a/Lz5JwU3",
    "https://imgur.com/a/Anyu2c1",
    "https://imgur.com/a/puuGI8e",
    "https://imgur.com/a/EIqGbAQ",
    "https://imgur.com/a/t3vR1TD",
    "https://imgur.com/a/cs2Kl1t",
    "https://imgur.com/a/sqgoyOk",
    "https://imgur.com/a/reqn2Nh",
    "https://imgur.com/a/R4hOq3u",
    "https://imgur.com/a/mJmhEUb",
  );

  public function getMemberPhoto(): string
  {
    return self::randomElement($this->photo);
  }

}