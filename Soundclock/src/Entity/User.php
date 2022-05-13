<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
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
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $name_user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $picture_user;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $description_user;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $certification_user;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $status_user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $label_user;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $slug_user;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $created_at_user;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $updated_at_user;

    /**
     * @ORM\ManyToMany(targetEntity=Music::class, mappedBy="user")
     */
    private $music;

    /**
     * @ORM\OneToMany(targetEntity=Playlist::class, mappedBy="user")
     */
    private $playlist;

    /**
     * @ORM\OneToMany(targetEntity=Review::class, mappedBy="user")
     */
    private $review;

    /**
     * @ORM\OneToMany(targetEntity=MusicLike::class, mappedBy="music")
     */
    private $musicLikes;

    /**
     * @ORM\OneToMany(targetEntity=MusicListen::class, mappedBy="music")
     */
    private $musicListens;

    public function __construct()
    {
        $this->music = new ArrayCollection();
        $this->playlist = new ArrayCollection();
        $this->review = new ArrayCollection();
        $this->musicLikes = new ArrayCollection();
        $this->musicListens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNameUser(): ?string
    {
        return $this->name_user;
    }

    public function setNameUser(string $name_user): self
    {
        $this->name_user = $name_user;

        return $this;
    }

    public function getPictureUser(): ?string
    {
        return $this->picture_user;
    }

    public function setPictureUser(?string $picture_user): self
    {
        $this->picture_user = $picture_user;

        return $this;
    }

    public function getDescriptionUser(): ?string
    {
        return $this->description_user;
    }

    public function setDescriptionUser(?string $description_user): self
    {
        $this->description_user = $description_user;

        return $this;
    }

    public function getCertificationUser(): ?bool
    {
        return $this->certification_user;
    }

    public function setCertificationUser(bool $certification_user): self
    {
        $this->certification_user = $certification_user;

        return $this;
    }

    public function getStatusUser(): ?int
    {
        return $this->status_user;
    }

    public function setStatusUser(int $status_user): self
    {
        $this->status_user = $status_user;

        return $this;
    }

    public function getLabelUser(): ?string
    {
        return $this->label_user;
    }

    public function setLabelUser(?string $label_user): self
    {
        $this->label_user = $label_user;

        return $this;
    }

    public function getSlugUser(): ?string
    {
        return $this->slug_user;
    }

    public function setSlugUser(string $slug_user): self
    {
        $this->slug_user = $slug_user;

        return $this;
    }

    public function getCreatedAtUser(): ?\DateTimeImmutable
    {
        return $this->created_at_user;
    }

    public function setCreatedAtUser(\DateTimeImmutable $created_at_user): self
    {
        $this->created_at_user = $created_at_user;

        return $this;
    }

    public function getUpdatedAtUser(): ?\DateTimeInterface
    {
        return $this->updated_at_user;
    }

    public function setUpdatedAtUser(?\DateTimeInterface $updated_at_user): self
    {
        $this->updated_at_user = $updated_at_user;

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
            $music->addUser($this);
        }

        return $this;
    }

    public function removeMusic(Music $music): self
    {
        if ($this->music->removeElement($music)) {
            $music->removeUser($this);
        }

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
            $playlist->setUser($this);
        }

        return $this;
    }

    public function removePlaylist(Playlist $playlist): self
    {
        if ($this->playlist->removeElement($playlist)) {
            // set the owning side to null (unless already changed)
            if ($playlist->getUser() === $this) {
                $playlist->setUser(null);
            }
        }

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
            $review->setUser($this);
        }

        return $this;
    }

    public function removeReview(Review $review): self
    {
        if ($this->review->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getUser() === $this) {
                $review->setUser(null);
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
            $musicLike->setMusic($this);
        }

        return $this;
    }

    public function removeMusicLike(MusicLike $musicLike): self
    {
        if ($this->musicLikes->removeElement($musicLike)) {
            // set the owning side to null (unless already changed)
            if ($musicLike->getMusic() === $this) {
                $musicLike->setMusic(null);
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
            $musicListen->setMusic($this);
        }

        return $this;
    }

    public function removeMusicListen(MusicListen $musicListen): self
    {
        if ($this->musicListens->removeElement($musicListen)) {
            // set the owning side to null (unless already changed)
            if ($musicListen->getMusic() === $this) {
                $musicListen->setMusic(null);
            }
        }

        return $this;
    }


}
