<?php

namespace App\EventSubscriber;

use App\Entity\Apply;
use App\Entity\Article;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Security;

class EntityPersistSubscriber implements EventSubscriber
{

  /** @var Security */
  private $security;

  /** @var UserPasswordHasherInterface */
  private $passwordHasher;

  public function __construct(Security $security, UserPasswordHasherInterface $passwordHasher)
  {
    $this->security = $security;
    $this->passwordHasher = $passwordHasher;
  }

  public function getSubscribedEvents(): array
  {
    return [
      Events::prePersist,
      Events::preUpdate,
    ];
  }

  public function prePersist(LifecycleEventArgs $args): void
  {
    $entity = $args->getObject();

    if (property_exists($entity, 'createdAt') && $entity->getCreatedAt() === null) {
      $entity->setCreatedAt(new DateTimeImmutable());
    }

    if (property_exists($entity, 'roles') && $entity->getRoles() === null) {
      $entity->setRoles(["ROLE_USER"]);
    }
  }

  public function preUpdate(LifecycleEventArgs $args): void
  {
    $entity = $args->getObject();

    if (property_exists($entity, 'updatedAt')) {
      $entity->setUpdatedAt(new DateTimeImmutable());
    }

    if ($entity instanceof Apply) {
      $this->checkApply($entity);
    }

    if ($entity instanceof User) {
      $this->checkUser($entity);
    }
  }

  private function checkApply(Apply $apply): void
  {

    if (!$apply->isIsAccepted()) {
      $acceptedBy = null;

    } else {
      $acceptedBy = $apply->getAcceptedBy();

      if ($acceptedBy === null) {
        $acceptedBy = $this->security->getUser();
      }
    }

    $apply->setAcceptedBy($acceptedBy);
  }

  private function checkUser(User $user): void
  {
    if (password_get_info($user->getPassword())['algo'] === null) {
      $user->setPassword($this->passwordHasher->hashPassword($user, $user->getPassword()));
    }
  }
}
