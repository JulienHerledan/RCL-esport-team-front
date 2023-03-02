<?php

namespace App\DataFixtures\Provider;

use Faker\Provider\Base;

class ArticleProvider extends Base
{
    private $photo = array(
        "https://imgur.com/bCiALwj",
        "https://imgur.com/LznM3WT",
        "https://imgur.com/JbeaFLu",
        "https://imgur.com/9lwYXxj",
        "https://imgur.com/1AHh2P6",

    );

    public function getArticlePhoto(): string
    
    { 
        return self::randomElement(($this->photo)) ;
    
    }


}