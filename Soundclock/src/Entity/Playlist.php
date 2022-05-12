<?php

namespace App\Entity;

use App\Repository\PlaylistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PlaylistRepository::class)
 */
class Playlist
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $name_playlist;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $picture_playlist;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $description_playlist;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $album;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $status_playlist;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $nblike_playlist;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $slug_playlist;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $created_at_playlist;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $updated_at_playlist;

    /**
     * @ORM\ManyToMany(targetEntity=Music::class, mappedBy="playlist")
     */
    private $music;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="playlist")
     */
    private $user;

    public function __construct()
    {
        $this->music = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Music>
     */
    public function getMusic(): Collection
    {
        return $this->music;
    }

    public function addMusic(Music $music): self
    {
        if (!$this->music->contains($music)) {
            $this->music[] = $music;
            $music->addPlaylist($this);
        }

        return $this;
    }

    public function removeMusic(Music $music): self
    {
        if ($this->music->removeElement($music)) {
            $music->removePlaylist($this);
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
