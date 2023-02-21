<?php

namespace App\DataFixtures;

use App\DataFixtures\Abstr\CoreFixture;
use App\Entity\Competition;
use App\Entity\Matche;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class MatcheFixtures extends CoreFixture implements DependentFixtureInterface
{

  protected function loadFakeData(): void
  {

    $competitions = $this->manager->getRepository(Competition::class)->findAll();
    $this->createMany(Matche::class, 5, function (Matche $matche) use ($competitions) {
      $matche
        ->setCompetition($this->faker->randomElement($competitions))
        ->setOpponent($this->faker->getOpponentName())
        ->setDate($this->faker->dateTime())
        ->setScore($this->faker->getRandomScore())
        ->setCreatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTime()));
    });
  }

  public function getDependencies(): array
  {
    return array(
      CompetitionFixtures::class,
    );
  }
}
