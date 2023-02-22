<?php

namespace App\DataFixtures;

use App\DataFixtures\Abstr\CoreFixture;
use App\Entity\Apply;
use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ApplyFixtures extends CoreFixture implements DependentFixtureInterface
{

    protected function loadFakeData(): void
    {

        $users = $this->manager->getRepository(User::class)->findAll();

        $this->createMany(Apply::class, 5, function (Apply $apply) use ($users) {
            $isAccepted = $this->faker->boolean();
            $apply
                ->setName($this->faker->userName())
                ->setEmail($this->faker->email())
                ->setPhoneNumber("06" . $this->faker->randomNumber(8,true))
                ->setPresentation($this->faker->paragraph())
                ->setIsAccepted($isAccepted)
                ->setCreatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTime()))
                ->setAcceptedBy($isAccepted ? $this->faker->randomElement($users) : null);
            
        });
    }

    public function getDependencies(): array
    {
        return array(
            UserFixtures::class,
        );
    }
}
