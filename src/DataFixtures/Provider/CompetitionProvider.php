<?php

namespace App\DataFixtures\Provider;

use Faker\Provider\Base;

class CompetitionProvider extends Base
{

  private $name = array(
    "League of Master World Championship",
    "Mid-Season Invitational",
    "All-Star Event",
    "Rift Master Rivals",
    "LCS Championship Series",
    "LCK Championship",
    "LEC Championship",
    "LPL Championship",
    "MSI Knockout Stage",
    "Worlds Play-In Stage"
  );

  public function getCompetitionName(): string
  {
    return self::randomElement($this->name);
  }

}
