<?php

namespace App\DataFixtures;

use App\DataFixtures\Abstr\CoreFixture;
use App\Entity\SocialNetwork;

class SocialNetworkFixtures extends CoreFixture
{

  protected function loadFakeData(): void
  {

    $this->createMany(SocialNetwork::class, 5, function (SocialNetwork $socialNetwork) {

      $socialNetwork
        ->setName($this->faker->getSocialNetworkName())
        ->setImage($this->faker->getRandomImageLink(30, 30))
        ->setCreatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTime()));

    });
  }

}
