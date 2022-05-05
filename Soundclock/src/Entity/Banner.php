<?php

namespace App\Entity;

use App\Repository\BannerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BannerRepository::class)
 */
class Banner
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
    private $name_banner;

    /**
     * @ORM\Column(type="integer")
     */
    private $status_banner;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at_banner;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at_banner;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameBanner(): ?string
    {
        return $this->name_banner;
    }

    public function setNameBanner(string $name_banner): self
    {
        $this->name_banner = $name_banner;

        return $this;
    }

    public function getStatusBanner(): ?int
    {
        return $this->status_banner;
    }

    public function setStatusBanner(int $status_banner): self
    {
        $this->status_banner = $status_banner;

        return $this;
    }

    public function getCreatedAtBanner(): ?\DateTimeImmutable
    {
        return $this->created_at_banner;
    }

    public function setCreatedAtBanner(\DateTimeImmutable $created_at_banner): self
    {
        $this->created_at_banner = $created_at_banner;

        return $this;
    }

    public function getUpdatedAtBanner(): ?\DateTimeInterface
    {
        return $this->updated_at_banner;
    }

    public function setUpdatedAtBanner(?\DateTimeInterface $updated_at_banner): self
    {
        $this->updated_at_banner = $updated_at_banner;

        return $this;
    }

}
