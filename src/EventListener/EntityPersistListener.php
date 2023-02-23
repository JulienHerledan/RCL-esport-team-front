<?php

namespace App\EventListener;

use DateTimeImmutable;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class EntityPersistListener
{
  public function __invoke(LifecycleEventArgs $args): void
  {
    $entity = $args->getObject();

    if (property_exists($entity, 'createdAt') && $entity->getCreatedAt() === null) {
      $entity->setCreatedAt(new DateTimeImmutable());
    }

    if (property_exists($entity, 'roles') && $entity->getRoles() === null) {
      $entity->setRoles(["ROLE_USER"]);
    }
  }

}
