<?php

namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ReviewRepository::class)
 */
class Review
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
    private $name_review;

    /**
     * @ORM\Column(type="text")
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $content_review;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $status_review;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $created_at_review;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"list_music"})
     * @Groups({"show_music"})
     */
    private $updated_at_review;

    /**
     * @ORM\ManyToOne(targetEntity=Music::class, inversedBy="review")
     */
    private $music;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="review")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameReview(): ?string
    {
        return $this->name_review;
    }

    public function setNameReview(string $name_review): self
    {
        $this->name_review = $name_review;

        return $this;
    }

    public function getContentReview(): ?string
    {
        return $this->content_review;
    }

    public function setContentReview(string $content_review): self
    {
        $this->content_review = $content_review;

        return $this;
    }

    public function getStatusReview(): ?int
    {
        return $this->status_review;
    }

    public function setStatusReview(int $status_review): self
    {
        $this->status_review = $status_review;

        return $this;
    }

    public function getCreatedAtReview(): ?\DateTimeImmutable
    {
        return $this->created_at_review;
    }

    public function setCreatedAtReview(\DateTimeImmutable $created_at_review): self
    {
        $this->created_at_review = $created_at_review;

        return $this;
    }

    public function getUpdatedAtReview(): ?\DateTimeInterface
    {
        return $this->updated_at_review;
    }

    public function setUpdatedAtReview(?\DateTimeInterface $updated_at_review): self
    {
        $this->updated_at_review = $updated_at_review;

        return $this;
    }

    public function getMusic(): ?Music
    {
        return $this->music;
    }

    public function setMusic(?Music $music): self
    {
        $this->music = $music;

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
