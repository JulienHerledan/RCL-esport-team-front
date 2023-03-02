<?php

namespace App\DataFixtures\Provider;

use Faker\Provider\Base;

class MemberProvider extends Base
{

  private $photo = array(
    "https://i.imgur.com/L6JHasf.png",
    "https://i.imgur.com/wI4KGWk.png",
    "https://i.imgur.com/9iYRiPV.png",
    "https://i.imgur.com/7gym46N.png",
    "https://i.imgur.com/BpBZIqA.png",
    "https://i.imgur.com/u2dtX5o.png",
    "https://i.imgur.com/ONwqtJG.png",
    "https://i.imgur.com/e0rfN9X.png",
    "https://i.imgur.com/KzqZTZF.png",
    "https://i.imgur.com/G0xIr0n.png",
  );

  public function getMemberPhoto(): string
  {
    return self::randomElement($this->photo);
  }

}