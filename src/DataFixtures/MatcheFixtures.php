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
    $this->createMany(Matche::class, 10, function (Matche $matche) use ($competitions) {

      $date = $this->faker->dateTimeBetween('-1 year', '+1 year');

      $matche
        ->setCompetition($this->faker->randomElement($competitions))
        ->setOpponentIcon($this->faker->unique()->getOpponentIcon())
        ->setOpponent($this->faker->unique()->getOpponentName())
        ->setDate($date)
        ->setScore($date->getTimestamp() > time() ? null : $this->faker->getRandomScore())
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
