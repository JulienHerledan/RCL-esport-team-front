<?php

namespace App\DataFixtures\Provider;

use Faker\Provider\Base;

class SocialNetworkProvider extends Base
{

  private $socialNetworks = array(
    array("Facebook", "fab fa-facebook-f"),
    array("Twitter", "fab fa-twitter"),
    array("Instagram", "fab fa-instagram"),
    array("LinkedIn", "fab fa-linkedin-in"),
    array("Snapchat", "fab fa-snapchat-ghost"),
    array("Pinterest", "fab fa-pinterest"),
    array("Reddit", "fab fa-reddit-alien"),
    array("YouTube", "fab fa-youtube"),
    array("WhatsApp", "fab fa-whatsapp"),
    array("TikTok", "fab fa-tiktok")
  );

  public function getSocialNetwork(): array
  {
    return self::randomElement($this->socialNetworks);
  }

}
