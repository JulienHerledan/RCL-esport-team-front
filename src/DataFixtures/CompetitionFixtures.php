<?php

namespace App\DataFixtures;

use App\DataFixtures\Abstr\CoreFixture;
use App\Entity\Competition;

class CompetitionFixtures extends CoreFixture
{

  protected function loadFakeData(): void
  {
    $this->createMany(Competition::class, 10, function (Competition $competition) {
      $competition
        ->setName($this->faker->unique()->getCompetitionName())
        ->setDate($this->faker->dateTime())
        ->setCreatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTime()));
    });
  }
}
