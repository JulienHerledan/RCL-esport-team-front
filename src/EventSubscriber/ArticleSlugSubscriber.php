<?php

namespace App\EventSubscriber;

use App\Entity\Article;
use App\Service\Slugger;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class ArticleSlugSubscriber implements EventSubscriber
{

  private $slugger;

  public function __construct(Slugger $slugger)
  {
    $this->slugger = $slugger;
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
    $this->updateSlug($args);
  }

  public function preUpdate(LifecycleEventArgs $args): void
  {
    $this->updateSlug($args);
  }

  private function updateSlug(LifecycleEventArgs $args): void
  {
    $entity = $args->getObject();

    if (!$entity instanceof Article) {
      return;
    }

    $entity->setSlug($this->slugger->sluggify($entity->getTitle()));
  }
}
