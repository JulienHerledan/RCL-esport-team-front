<?php

namespace App\DataFixtures;

use App\DataFixtures\Abstr\CoreFixture;
use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CommentFixtures extends CoreFixture implements DependentFixtureInterface
{

  protected function loadFakeData(): void
  {
    // I need bring all the users and all the articles
    $users = $this->manager->getRepository(User::class)->findAll();
    $articles = $this->manager->getRepository(Article::class)->findAll();

    $this->createMany(Comment::class, 200, function (Comment $comment) use ($users, $articles) {
      $comment
        ->setMessage($this->faker->sentence())
        ->setAuthor($this->faker->randomElement($users))
        ->setArticle($this->faker->randomElement($articles))
        ->setCreatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTime()));
    });
  }

  public function getDependencies(): array
  {
    return array(
      UserFixtures::class,
      ArticleFixtures::class,
    );
  }
}
