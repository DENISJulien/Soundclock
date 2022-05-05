<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

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
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name_user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture_user;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description_user;

    /**
     * @ORM\Column(type="boolean")
     */
    private $certification_user;

    /**
     * @ORM\Column(type="integer")
     */
    private $status_user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $label_user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug_user;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at_user;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at_user;

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

}
