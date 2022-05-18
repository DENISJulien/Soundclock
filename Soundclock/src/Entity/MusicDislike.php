<?php

namespace App\Entity;

use App\Repository\MusicDislikeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MusicDislikeRepository::class)
 */
class MusicDislike
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"list_music_dislike"})
     * @Groups({"show_music_dislike"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Music::class, inversedBy="musicDislikes")
     * @Groups({"list_music_dislike"})
     * @Groups({"show_music_dislike"})
     */
    private $musicDisliked;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="musicDislikeByUser")
     * @Groups({"list_music_dislike"})
     * @Groups({"show_music_dislike"})
     */
    private $userWhoDislikeMusic;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMusicDisliked(): ?Music
    {
        return $this->musicDisliked;
    }

    public function setMusicDisliked(?Music $musicDisliked): self
    {
        $this->musicDisliked = $musicDisliked;

        return $this;
    }

    public function getUserWhoDislikeMusic(): ?User
    {
        return $this->userWhoDislikeMusic;
    }

    public function setUserWhoDislikeMusic(?User $userWhoDislikeMusic): self
    {
        $this->userWhoDislikeMusic = $userWhoDislikeMusic;

        return $this;
    }
}
