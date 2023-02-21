<?php

namespace App\DataFixtures;

use App\DataFixtures\Abstr\CoreFixture;
use App\Entity\Game;
use App\Entity\VideoClip;

class VideoClipFixtures extends CoreFixture
{

  protected function loadFakeData(): void
  {

    $this->createMany(VideoClip::class, 5, function (VideoClip $videoClip) {
      $videoClip
        ->setLink($this->faker->getRandomYoutubeLink())
        ->setDate($this->faker->dateTime())
        ->setCreatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTime()));
    });
  }
}
