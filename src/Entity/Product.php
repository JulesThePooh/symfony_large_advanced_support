<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\MappedSuperclass;
use Symfony\Component\Validator\Constraints as Assert;

#[MappedSuperclass]
#[ORM\HasLifecycleCallbacks]
class Product
{

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 10,
        max: 20,
        minMessage: 'Le titre doit avoir au minimum {{ limit }} caractères',
        maxMessage: 'Le titre doit avoir au maximum {{ limit }} caractères',
    )]
    protected ?string $title = null;

    #[ORM\Column(length: 255)]
    protected ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    protected ?\DateTimeInterface $createdAt = null;


    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->createdAt = new \DateTime();
    }
}
