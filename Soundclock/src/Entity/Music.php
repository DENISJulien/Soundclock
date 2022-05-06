<?php

namespace App\Entity;

use App\Repository\MusicRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MusicRepository::class)
 */
class Music
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
    private $name_music;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $file_music;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture_music;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description_music;

    /**
     * @ORM\Column(type="integer")
     */
    private $status_music;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $relaesedate_music;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nblike_music;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nblistened_music;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug_music;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at_music;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at_music;

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

    public function getRelaesedateMusic(): ?\DateTimeImmutable
    {
        return $this->relaesedate_music;
    }

    public function setRelaesedateMusic(\DateTimeImmutable $relaesedate_music): self
    {
        $this->relaesedate_music = $relaesedate_music;

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
}
