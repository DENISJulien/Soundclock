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
    private $status_genre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug_genre;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at_genre;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at_genre;


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

}
