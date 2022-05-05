<?php

namespace App\Entity;

use App\Repository\GenreRepository;
use Doctrine\ORM\Mapping as ORM;

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
     */
    private $name_genre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture_genre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description_genre;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

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

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
