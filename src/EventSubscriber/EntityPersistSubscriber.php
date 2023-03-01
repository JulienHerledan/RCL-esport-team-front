<?php

namespace App\EventSubscriber;

use App\Entity\Apply;
use App\Entity\Article;
use DateTimeImmutable;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Security;

class EntityPersistSubscriber implements EventSubscriber
{

  private $security;

  public function __construct(Security $security)
  {
    $this->security = $security;
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
      $this->checksApply($entity);
    }
  }

  public function checksApply(Apply $apply): void
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
}
