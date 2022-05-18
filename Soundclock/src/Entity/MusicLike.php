<?php

namespace App\Entity;

use App\Repository\MusicLikeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MusicLikeRepository::class)
 */
class MusicLike
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"list_music_like"})
     * @Groups({"show_music_like"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Music::class, inversedBy="musicLikes")
     * @Groups({"list_music_like"})
     * @Groups({"show_music_like"})
     */
    private $musicLiked;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="musicLikeByUser")
     * @Groups({"list_music_like"})
     * @Groups({"show_music_like"})
     */
    private $userWhoLikeMusic;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMusicLiked(): ?Music
    {
        return $this->musicLiked;
    }

    public function setMusicLiked(?Music $musicLiked): self
    {
        $this->musicLiked = $musicLiked;

        return $this;
    }

    public function getUserWhoLikeMusic(): ?User
    {
        return $this->userWhoLikeMusic;
    }

    public function setUserWhoLikeMusic(?User $userWhoLikeMusic): self
    {
        $this->userWhoLikeMusic = $userWhoLikeMusic;

        return $this;
    }

}
