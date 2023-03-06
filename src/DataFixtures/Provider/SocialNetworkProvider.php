<?php

namespace App\DataFixtures\Provider;

use Faker\Provider\Base;

class SocialNetworkProvider extends Base
{

  private $socialNetworks = array(
    array("Facebook", "FaFacebook"),
    array("Twitter", "FaTwitter"),
    array("Instagram", "FaInstagram"),
    array("LinkedIn", "FaLinkedinIn"),
    array("Snapchat", "FaSnapchatGhost"),
    array("Pinterest", "FaPinterest"),
    array("Reddit", "FaReddit"),
    array("YouTube", "FaYoutube"),
    array("WhatsApp", "FaWhatsapp"),
    array("TikTok", "FaTiktok")
  );

  public function getSocialNetwork(): array
  {
    return self::randomElement($this->socialNetworks);
  }

}
