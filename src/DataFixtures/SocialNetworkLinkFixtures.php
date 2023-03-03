<?php

namespace App\DataFixtures;

use App\DataFixtures\Abstr\CoreFixture;
use App\Entity\Member;
use App\Entity\SocialNetwork;
use App\Entity\SocialNetworkLink;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SocialNetworkLinkFixtures extends CoreFixture implements DependentFixtureInterface
{

  protected function loadFakeData(): void
  {

    $socialNetworkList = $this->manager->getRepository(SocialNetwork::class)->findAll();
    $members = $this->manager->getRepository(Member::class)->findAll();

    foreach ($members as $member) {
      $availableNetworkLinks = $socialNetworkList;
      $socialNetworkNumber = rand(1, 3);

      for ($i = 0; $i < $socialNetworkNumber; $i++) {
        $socialNetworkLink = new SocialNetworkLink();

        shuffle($availableNetworkLinks);

        $socialNetworkLink
          ->setLink($this->faker->url())
          ->setSocialNetwork(array_pop($availableNetworkLinks))
          ->setMember($member);

        $this->manager->persist($socialNetworkLink);
      }
    }
    $this->manager->flush();
  }

  public function getDependencies(): array
  {
    return array(
      MemberFixtures::class,
      SocialNetworkFixtures::class
    );
  }

  private function checkIfNetworkExists(array $haystack, string $name): bool
  {
    foreach ($haystack as $network) {
      if ($network->getName() === $name) {
        return true;
      }
    }
    return false;
  }
}
