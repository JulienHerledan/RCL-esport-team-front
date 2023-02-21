<?php

namespace App\DataFixtures;

use App\DataFixtures\Abstr\CoreFixture;
use App\Entity\Article;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ArticleFixtures extends CoreFixture implements DependentFixtureInterface
{

  protected function loadFakeData(): void
  {

    $users = $this->manager->getRepository(User::class)->findAll();
    $this->createMany(Article::class, 5, function (Article $article) use ($users) {
      $article
        ->setTitle($this->faker->sentence())
        ->setThumbnail($this->faker->getRandomImageLink(60, 60))
        ->setResume($this->faker->text(30))
        ->setContent($this->faker->text(500))
        ->setAuthor($this->faker->randomElement($users))
        ->setCreatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTime()));
    });
  }

  public function getDependencies(): array
  {
    return array(
      UserFixtures::class,
    );
  }
}
