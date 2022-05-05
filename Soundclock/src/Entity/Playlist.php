<?php

namespace App\Entity;

use App\Repository\PlaylistRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlaylistRepository::class)
 */
class Playlist
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name_playlist;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture_playlist;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description_playlist;

    /**
     * @ORM\Column(type="boolean")
     */
    private $album;

    /**
     * @ORM\Column(type="integer")
     */
    private $status_playlist;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nblike_playlist;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug_playlist;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at_playlist;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at_playlist;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNamePlaylist(): ?string
    {
        return $this->name_playlist;
    }

    public function setNamePlaylist(string $name_playlist): self
    {
        $this->name_playlist = $name_playlist;

        return $this;
    }

    public function getPicturePlaylist(): ?string
    {
        return $this->picture_playlist;
    }

    public function setPicturePlaylist(?string $picture_playlist): self
    {
        $this->picture_playlist = $picture_playlist;

        return $this;
    }

    public function getDescriptionPlaylist(): ?string
    {
        return $this->description_playlist;
    }

    public function setDescriptionPlaylist(?string $description_playlist): self
    {
        $this->description_playlist = $description_playlist;

        return $this;
    }

    public function getAlbum(): ?bool
    {
        return $this->album;
    }

    public function setAlbum(bool $album): self
    {
        $this->album = $album;

        return $this;
    }

    public function getStatusPlaylist(): ?int
    {
        return $this->status_playlist;
    }

    public function setStatusPlaylist(int $status_playlist): self
    {
        $this->status_playlist = $status_playlist;

        return $this;
    }

    public function getNblikePlaylist(): ?int
    {
        return $this->nblike_playlist;
    }

    public function setNblikePlaylist(?int $nblike_playlist): self
    {
        $this->nblike_playlist = $nblike_playlist;

        return $this;
    }

    public function getSlugPlaylist(): ?string
    {
        return $this->slug_playlist;
    }

    public function setSlugPlaylist(string $slug_playlist): self
    {
        $this->slug_playlist = $slug_playlist;

        return $this;
    }

    public function getCreatedAtPlaylist(): ?\DateTimeImmutable
    {
        return $this->created_at_playlist;
    }

    public function setCreatedAtPlaylist(\DateTimeImmutable $created_at_playlist): self
    {
        $this->created_at_playlist = $created_at_playlist;

        return $this;
    }

    public function getUpdatedAtPlaylist(): ?\DateTimeInterface
    {
        return $this->updated_at_playlist;
    }

    public function setUpdatedAtPlaylist(?\DateTimeInterface $updated_at_playlist): self
    {
        $this->updated_at_playlist = $updated_at_playlist;

        return $this;
    }
}
