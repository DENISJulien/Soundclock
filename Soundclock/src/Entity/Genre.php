<?php

namespace App\Entity;

use App\Repository\GenreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=GenreRepository::class)
 */
class Genre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"list_genre"})
     * @Groups({"show_genre"})
     */
    private $name_genre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"list_genre"})
     * @Groups({"show_genre"})
     */
    private $picture_genre;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"list_genre"})
     * @Groups({"show_genre"})
     */
    private $description_genre;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"list_genre"})
     * @Groups({"show_genre"})
     */
    private $status_genre;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"list_genre"})
     * @Groups({"show_genre"})
     */
    private $slug_genre;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups({"list_genre"})
     * @Groups({"show_genre"})
     */
    private $created_at_genre;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"list_genre"})
     * @Groups({"show_genre"})
     */
    private $updated_at_genre;

    /**
     * @ORM\ManyToMany(targetEntity=Music::class, mappedBy="genre")
     * @Groups({"list_genre"})
     * @Groups({"show_genre"})
     */
    private $music;

    public function __construct()
    {
        $this->music = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameGenre(): ?string
    {
        return $this->name_genre;
    }

    public function setNameGenre(string $name_genre): self
    {
        $this->name_genre = $name_genre;

        return $this;
    }

    public function getPictureGenre(): ?string
    {
        return $this->picture_genre;
    }

    public function setPictureGenre(?string $picture_genre): self
    {
        $this->picture_genre = $picture_genre;

        return $this;
    }

    public function getDescriptionGenre(): ?string
    {
        return $this->description_genre;
    }

    public function setDescriptionGenre(?string $description_genre): self
    {
        $this->description_genre = $description_genre;

        return $this;
    }

    public function getStatusGenre(): ?int
    {
        return $this->status_genre;
    }

    public function setStatusGenre(int $status_genre): self
    {
        $this->status_genre = $status_genre;

        return $this;
    }

    public function getSlugGenre(): ?string
    {
        return $this->slug_genre;
    }

    public function setSlugGenre(string $slug_genre): self
    {
        $this->slug_genre = $slug_genre;

        return $this;
    }

    public function getCreatedAtGenre(): ?\DateTimeImmutable
    {
        return $this->created_at_genre;
    }

    public function setCreatedAtGenre(\DateTimeImmutable $created_at_genre): self
    {
        $this->created_at_genre = $created_at_genre;

        return $this;
    }

    public function getUpdatedAtGenre(): ?\DateTimeInterface
    {
        return $this->updated_at_genre;
    }

    public function setUpdatedAtGenre(?\DateTimeInterface $updated_at_genre): self
    {
        $this->updated_at_genre = $updated_at_genre;

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
            $music->addGenre($this);
        }

        return $this;
    }

    public function removeMusic(Music $music): self
    {
        if ($this->music->removeElement($music)) {
            $music->removeGenre($this);
        }

        return $this;
    }

}
