<?php

namespace App\DataFixtures\Abstr;

use App\DataFixtures\Provider\ArticleProvider;
use App\DataFixtures\Provider\CompetitionProvider;
use App\DataFixtures\Provider\GameProvider;
use App\DataFixtures\Provider\MatcheProvider;
use App\DataFixtures\Provider\MemberProvider;
use App\DataFixtures\Provider\RandomProvider;
use App\DataFixtures\Provider\SocialNetworkProvider;
use App\DataFixtures\Provider\UserProvider;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

abstract class CoreFixture extends Fixture
{

  protected $faker;
  protected $manager;

  public function __construct()
  {
    $this->faker = Factory::create('fr_FR');
    $this->faker->addProvider(new RandomProvider($this->faker));
    $this->faker->addProvider(new CompetitionProvider($this->faker));
    $this->faker->addProvider(new GameProvider($this->faker));
    $this->faker->addProvider(new MatcheProvider($this->faker));
    $this->faker->addProvider(new SocialNetworkProvider($this->faker));
    $this->faker->addProvider(new UserProvider($this->faker));
    $this->faker->addProvider(new ArticleProvider($this->faker));
    $this->faker->addProvider(new MemberProvider($this->faker));
  }

  public function load(ObjectManager $manager): void
  {
    $this->manager = $manager;

    $this->loadFakeData();
  }

  protected function createMany(string $fqcn, int $count, callable $factory): void
  {
    for ($i = 0; $i < $count; $i++) {
      $entity = new $fqcn();
      $factory($entity, $i);
      $this->manager->persist($entity);
    }
    $this->manager->flush();
  }

  abstract protected function loadFakeData(): void;
}
