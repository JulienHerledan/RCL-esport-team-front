<?php

namespace App\DataFixtures\Provider;

use Faker\Provider\Base;

class MatcheProvider extends Base
{

  private $opponentName = array(
    "G2 Esports",
    "SK Telecom T1",
    "Fnatic",
    "Invictus Gaming",
    "Cloud9",
    "Royal Never Give Up",
    "Team SoloMid",
    "KT Rolster",
    "Team Liquid",
    "Samsung Galaxy"
  );

  public function getOpponentName(): string
  {
    return self::randomElement($this->opponentName);
  }

}
