<?php

namespace App\EventListener;

use App\Entity\Music;
use App\Service\MySlugger;

class MusicListener
{
    private $slugger;

    public function __construct(MySlugger $slugger)
    {
        $this->slugger = $slugger;    
    }

    public function updateMusic(Music $music)
    {
        $slug = $this->slugger->slugify($music->getNameMusic());
        $music->setSlugMusic($slug);
    }

}