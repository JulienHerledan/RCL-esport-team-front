<?php

namespace App\DataFixtures\Provider;

use Faker\Generator;
use Faker\Provider\Base;

class RandomProvider extends Base
{

  private $youtubeChars = 'abcdefghijklmnopqrstuvwxyz0123456789';

  public function getRandomImageLink(int $width, int $height): string
  {
    return "https://picsum.photos/" . self::randomNumber(3) . "/" . $width . "/" . $height;
  }

  public function getRandomScore(): string
  {

    $myScore = self::randomDigitNotNull();

    $theirScore = self::randomDigitNotNull();

    while ($theirScore === $myScore) {
      $theirScore = self::randomDigitNotNull();
    }

    return $myScore . "-" . $theirScore;
  }

  public function getRandomYoutubeLink(): string
  {
    $random_string = '';

    for ($i = 0; $i < 11; $i++) {
      $random_string .= $this->youtubeChars[random_int(0, strlen($this->youtubeChars) - 1)];
    }
    return 'https://www.youtube.com/watch?v=' . $random_string;
  }
}
