<?php

namespace App\DataFixtures;

use App\DataFixtures\Abstr\CoreFixture;
use App\Entity\Game;

class GameFixtures extends CoreFixture
{

  protected function loadFakeData(): void
  {

    $this->createMany(Game::class, 10, function (Game $game) {
      $game
        ->setName($this->faker->unique()->getGameName())
        ->setPhoto($this->faker->getRandomImageLink(30,30))
        ->setCreatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTime()));
    });
  }
}
