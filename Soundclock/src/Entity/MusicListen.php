<?php

namespace App\Entity;

use App\Repository\MusicListenRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MusicListenRepository::class)
 */
class MusicListen
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     * @Groups({"list_like_music"})
     * @Groups({"show_like_music"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="musicListens")
     * @Groups({"list_like_music"})
     * @Groups({"show_like_music"})
     */
    private $music;

    /**
     * @ORM\ManyToOne(targetEntity=Music::class, inversedBy="musicListens")
     * @Groups({"list_like_music"})
     * @Groups({"show_like_music"})
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMusic(): ?User
    {
        return $this->music;
    }

    public function setMusic(?User $music): self
    {
        $this->music = $music;

        return $this;
    }

    public function getUser(): ?Music
    {
        return $this->user;
    }

    public function setUser(?Music $user): self
    {
        $this->user = $user;

        return $this;
    }
}
