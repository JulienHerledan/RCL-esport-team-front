<?php

namespace App\DataFixtures\Provider;

use Faker\Provider\Base;

class ArticleProvider extends Base
{
    private $photo = array(
        "https://i.imgur.com/bCiALwj.jpeg",
        "https://i.imgur.com/LznM3WT.jpg",
        "https://i.imgur.com/JbeaFLu.jpg",
        "https://i.imgur.com/9lwYXxj.jpg",
        "https://i.imgur.com/1AHh2P6.jpg",

    );

    public function getArticlePhoto(): string
    
    { 
        return self::randomElement(($this->photo)) ;
    
    }


}