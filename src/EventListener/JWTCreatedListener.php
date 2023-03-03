<?php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\User\UserInterface;

class JWTCreatedListener
{
  /**
   * @param AuthenticationSuccessEvent $event
   */
  public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event): void
  {
    $data = $event->getData();
    $user = $event->getUser();

    if (!$user instanceof UserInterface) {
      return;
    }

    $data['data'] = array(
      'email' => $user->getEmail(),
      'nickname' => $user->getNickname(),
      'roles' => $user->getRoles(),
    );

    $event->setData($data);
  }
}
