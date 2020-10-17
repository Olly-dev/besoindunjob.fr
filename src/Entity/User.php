<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 * @package App\Entity
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"job_seeker" = "App\Entity\JobSeeker", "recruiter" = "App\Entity\Recruiter"})
 */
abstract class User implements UserInterface
{
    /**
     * @var int|null
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected ?int $id = null;

    /**
     * @var string|null
     * @ORM\Column
     */
    protected ?string $firstName = null;
    
    /**
     * @var string|null
     * @ORM\Column
     */
    protected ?string $lastName = null;

    /**
     * @var string|null
     * @ORM\Column(unique=true)
     */
    protected ?string $email = null;

    /**
     * @var string|null
     * @ORM\Column
     */
    protected ?string $password = null;

    /**
     * @var string|null
     */
    protected ?string $plainPassword = null;

    /**
     * @var \DateTimeInterface
     * @ORM\Column(type="datetime_immutable")
     */
    protected \DateTimeInterface $registredAt;

    /**
     * User Construct
     */
    public function __construct()
    {
        $this->registredAt = new \DateTimeImmutable();
    }

    /**
     * Get the value of id
     *
     * @return  int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  int|null  $id
     *
     * @return  self
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of firstName
     *
     * @return  string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @param  string|null  $firstName
     *
     * @return  self
     */
    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of lastName
     *
     * @return  string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @param  string|null  $lastName
     *
     * @return  self
     */
    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of email
     *
     * @return  string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  string|null  $email
     *
     * @return  self
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     *
     * @return  string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param  string|null  $password
     *
     * @return  self
     */
    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of plainPassword
     *
     * @return  string|null
     */
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    /**
     * Set the value of plainPassword
     *
     * @param  string|null  $plainPassword
     *
     * @return  self
     */
    public function setPlainPassword(?string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * Get the value of registredAt
     *
     * @return  \DateTimeInterface
     */
    public function getRegistredAt(): \DateTimeInterface
    {
        return $this->registredAt;
    }

    /**
     * @inheritDoc
     *
     * @return void
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * @inheritDoc
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }
}
