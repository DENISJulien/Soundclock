<?php

namespace App\Entity;

use App\Repository\MusicRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MusicRepository::class)
 */
class Music
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"list_genre"})
     * @Groups({"show_genre"})
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"list_genre"})
     * @Groups({"show_genre"})
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $name_music;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"list_genre"})
     * @Groups({"show_genre"})
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $file_music;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"list_genre"})
     * @Groups({"show_genre"})
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $picture_music;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"list_genre"})
     * @Groups({"show_genre"})
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $description_music;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"list_genre"})
     * @Groups({"show_genre"})
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $status_music;

    /**
     * @ORM\Column(type="date")
     * @Groups({"list_genre"})
     * @Groups({"show_genre"})
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $releasedate_music;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"list_genre"})
     * @Groups({"show_genre"})
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $nblike_music;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"list_genre"})
     * @Groups({"show_genre"})
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $nblistened_music;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"list_genre"})
     * @Groups({"show_genre"})
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $slug_music;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups({"list_genre"})
     * @Groups({"show_genre"})
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $created_at_music;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"list_genre"})
     * @Groups({"show_genre"})
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $updated_at_music;

    /**
     * @ORM\ManyToMany(targetEntity=Genre::class, inversedBy="music")
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $genre;

    /**
     * @ORM\ManyToMany(targetEntity=Playlist::class, inversedBy="music")
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $playlist;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="music")
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Review::class, mappedBy="music")
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $review;

    /**
     * @ORM\OneToMany(targetEntity=MusicLike::class, mappedBy="user")
     */
    private $musicLikes;

    /**
     * @ORM\OneToMany(targetEntity=MusicListen::class, mappedBy="user")
     */
    private $musicListens;


    public function __construct()
    {
        $this->genre = new ArrayCollection();
        $this->playlist = new ArrayCollection();
        $this->user = new ArrayCollection();
        $this->review = new ArrayCollection();
        $this->musicLikes = new ArrayCollection();
        $this->musicListens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameMusic(): ?string
    {
        return $this->name_music;
    }

    public function setNameMusic(string $name_music): self
    {
        $this->name_music = $name_music;

        return $this;
    }

    public function getFileMusic(): ?string
    {
        return $this->file_music;
    }

    public function setFileMusic(string $file_music): self
    {
        $this->file_music = $file_music;

        return $this;
    }

    public function getPictureMusic(): ?string
    {
        return $this->picture_music;
    }

    public function setPictureMusic(?string $picture_music): self
    {
        $this->picture_music = $picture_music;

        return $this;
    }

    public function getDescriptionMusic(): ?string
    {
        return $this->description_music;
    }

    public function setDescriptionMusic(?string $description_music): self
    {
        $this->description_music = $description_music;

        return $this;
    }

    public function getStatusMusic(): ?int
    {
        return $this->status_music;
    }

    public function setStatusMusic(?int $status_music): self
    {
        $this->status_music = $status_music;

        return $this;
    }

    public function getReleasedateMusic(): ?\DateTimeInterface
    {
        return $this->releasedate_music;
    }

    public function setReleasedateMusic(\DateTimeInterface $releasedate_music): self
    {
        $this->releasedate_music = $releasedate_music;

        return $this;
    }

    public function getNblikeMusic(): ?int
    {
        return $this->nblike_music;
    }

    public function setNblikeMusic(?int $nblike_music): self
    {
        $this->nblike_music = $nblike_music;

        return $this;
    }

    public function getNblistenedMusic(): ?int
    {
        return $this->nblistened_music;
    }

    public function setNblistenedMusic(?int $nblistened_music): self
    {
        $this->nblistened_music = $nblistened_music;

        return $this;
    }

    public function getSlugMusic(): ?string
    {
        return $this->slug_music;
    }

    public function setSlugMusic(string $slug_music): self
    {
        $this->slug_music = $slug_music;

        return $this;
    }

    public function getCreatedAtMusic(): ?\DateTimeImmutable
    {
        return $this->created_at_music;
    }

    public function setCreatedAtMusic(\DateTimeImmutable $created_at_music): self
    {
        $this->created_at_music = $created_at_music;

        return $this;
    }

    public function getUpdatedAtMusic(): ?\DateTimeInterface
    {
        return $this->updated_at_music;
    }

    public function setUpdatedAtMusic(?\DateTimeInterface $updated_at_music): self
    {
        $this->updated_at_music = $updated_at_music;

        return $this;
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenre(): Collection
    {
        return $this->genre;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genre->contains($genre)) {
            $this->genre[] = $genre;
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        $this->genre->removeElement($genre);

        return $this;
    }

    /**
     * @return Collection<int, Playlist>
     */
    public function getPlaylist(): Collection
    {
        return $this->playlist;
    }

    public function addPlaylist(Playlist $playlist): self
    {
        if (!$this->playlist->contains($playlist)) {
            $this->playlist[] = $playlist;
        }

        return $this;
    }

    public function removePlaylist(Playlist $playlist): self
    {
        $this->playlist->removeElement($playlist);

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->user->removeElement($user);

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getReview(): Collection
    {
        return $this->review;
    }

    public function addReview(Review $review): self
    {
        if (!$this->review->contains($review)) {
            $this->review[] = $review;
            $review->setMusic($this);
        }

        return $this;
    }

    public function removeReview(Review $review): self
    {
        if ($this->review->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getMusic() === $this) {
                $review->setMusic(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MusicLike>
     */
    public function getMusicLikes(): Collection
    {
        return $this->musicLikes;
    }

    public function addMusicLike(MusicLike $musicLike): self
    {
        if (!$this->musicLikes->contains($musicLike)) {
            $this->musicLikes[] = $musicLike;
            $musicLike->setUser($this);
        }

        return $this;
    }

    public function removeMusicLike(MusicLike $musicLike): self
    {
        if ($this->musicLikes->removeElement($musicLike)) {
            // set the owning side to null (unless already changed)
            if ($musicLike->getUser() === $this) {
                $musicLike->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MusicListen>
     */
    public function getMusicListens(): Collection
    {
        return $this->musicListens;
    }

    public function addMusicListen(MusicListen $musicListen): self
    {
        if (!$this->musicListens->contains($musicListen)) {
            $this->musicListens[] = $musicListen;
            $musicListen->setUser($this);
        }

        return $this;
    }

    public function removeMusicListen(MusicListen $musicListen): self
    {
        if ($this->musicListens->removeElement($musicListen)) {
            // set the owning side to null (unless already changed)
            if ($musicListen->getUser() === $this) {
                $musicListen->setUser(null);
            }
        }

        return $this;
    }

}
