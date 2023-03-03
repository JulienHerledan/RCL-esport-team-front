<?php

namespace App\DataFixtures;

use App\DataFixtures\Abstr\CoreFixture;
use App\Entity\SocialNetwork;

class SocialNetworkFixtures extends CoreFixture
{

  protected function loadFakeData(): void
  {

    $this->createMany(SocialNetwork::class, 10, function (SocialNetwork $socialNetwork) {

      $newSocialNetwork = $this->faker->unique()->getSocialNetwork();

      $socialNetwork
        ->setName($newSocialNetwork[0])
        ->setImage($newSocialNetwork[1])
        ->setCreatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTime()));

    });
  }

}
