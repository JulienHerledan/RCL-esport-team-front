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
        ->setTitle($this->faker->text(30))
        ->setImage($this->faker->getRandomImageLink(1024, 546))
        ->setResume($this->faker->text(300))
        ->setContent($this->faker->realTextBetween(2000, 3000))
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
