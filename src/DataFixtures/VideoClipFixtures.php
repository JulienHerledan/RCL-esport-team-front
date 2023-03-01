<?php

namespace App\DataFixtures;

use App\DataFixtures\Abstr\CoreFixture;
use App\Entity\Game;
use App\Entity\Member;
use App\Entity\VideoClip;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class VideoClipFixtures extends CoreFixture implements DependentFixtureInterface
{

  protected function loadFakeData(): void
  {

    $members = $this->manager->getRepository(Member::class)->findAll();

    $this->createMany(VideoClip::class, 5, function (VideoClip $videoClip) use ($members) {
      $videoClip
        ->setLink($this->faker->getRandomYoutubeLink())
        ->setDate($this->faker->dateTime())
        ->setCreatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTime()));

      for ($i = 1; $i <= rand(1, 5); $i++) {
        $videoClip->addMember($this->faker->randomElement($members));
      }
    });
  }

  public function getDependencies(): array
  {
    return array(
      MemberFixtures::class,
    );
  }
}
