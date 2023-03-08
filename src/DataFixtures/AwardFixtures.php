<?php

namespace App\DataFixtures;

use App\DataFixtures\Abstr\CoreFixture;
use App\Entity\Article;
use App\Entity\Award;
use App\Entity\Competition;
use App\Entity\Member;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AwardFixtures extends CoreFixture implements DependentFixtureInterface
{

  protected function loadFakeData(): void
  {

    $member = $this->manager->getRepository(Member::class)->findAll();
    $competition = $this->manager->getRepository(Competition::class)->findAll();

    $this->createMany(Award::class, 10, function (Award $award) use ($member, $competition) {
      $award
        ->setCompetition($this->faker->randomElement($competition))
        ->setRank($this->faker->numberBetween(1, 3))
        ->addMember($this->faker->randomElement($member));
    });
  }

  public function getDependencies(): array
  {
    return array(
      UserFixtures::class,
      MemberFixtures::class,
      CompetitionFixtures::class
    );
  }
}
