<?php

namespace App\DataFixtures\Provider;

use Faker\Provider\Base;



class MatcheProvider extends Base
{
  private $opponentIcon = array(
    "https://i.imgur.com/KRYINVb.jpg",
    "https://i.imgur.com/nn3FBVw.jpg",
    "https://i.imgur.com/q7PxdxO.jpg",
    "https://i.imgur.com/4tq2v4T.jpg",
    "https://i.imgur.com/KLDPl30.jpg",
    "https://i.imgur.com/NsTYzYk.png",
    "https://i.imgur.com/TPyLOLI.png",
    "https://i.imgur.com/zMGbZi9.png",
    "https://i.imgur.com/7c9YywJ.png",
    "https://i.imgur.com/NWgqOzw.png",
  );

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

  public function getOpponentIcon(): string
  {
    return self::randomElement($this->opponentIcon);
  }


}
