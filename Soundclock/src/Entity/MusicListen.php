<?php

namespace App\Entity;

use App\Repository\MusicListenRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MusicListenRepository::class)
 */
class MusicListen
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="musicListens")
     */
    private $music;

    /**
     * @ORM\ManyToOne(targetEntity=Music::class, inversedBy="musicListens")
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
