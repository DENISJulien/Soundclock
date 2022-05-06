<?php

namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReviewRepository::class)
 */
class Review
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
    private $name_review;

    /**
     * @ORM\Column(type="text")
     */
    private $content_review;

    /**
     * @ORM\Column(type="integer")
     */
    private $status_review;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at_review;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at_review;

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
}
