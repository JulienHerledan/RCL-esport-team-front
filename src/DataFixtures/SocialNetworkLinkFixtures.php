<?php

namespace App\DataFixtures;

use App\DataFixtures\Abstr\CoreFixture;
use App\Entity\Article;
use App\Entity\Member;
use App\Entity\SocialNetwork;
use App\Entity\SocialNetworkLink;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SocialNetworkLinkFixtures extends CoreFixture implements DependentFixtureInterface
{

  protected function loadFakeData(): void
  {

    $socialNetwork = $this->manager->getRepository(SocialNetwork::class)->findAll();
    $members = $this->manager->getRepository(Member::class)->findAll();
    $this->createMany(SocialNetworkLink::class, 5, function (SocialNetworkLink $socialNetworkLink) use ($socialNetwork, $members) {
      $socialNetworkLink
        ->setLink($this->faker->url())
        ->setSocialNetwork($this->faker->randomElement($socialNetwork))
        ->setMember($this->faker->randomElement($members));
    });
  }

  public function getDependencies(): array
  {
    return array(
      MemberFixtures::class,
      SocialNetworkFixtures::class
    );
  }
}
