<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\DemandeVendorRepository;

#[ORM\Entity(repositoryClass: DemandeVendorRepository::class)]
#[ApiResource]
//#[Get,Post,Delete,Patch]
class DemandeVendor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'demandeVendors')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $whoUser = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(nullable: true)]
    private ?bool $accepted = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWhoUser(): ?User
    {
        return $this->whoUser;
    }

    public function setWhoUser(?User $whoUser): self
    {
        $this->whoUser = $whoUser;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function isAccepted(): ?bool
    {
        return $this->accepted;
    }

    public function setAccepted(bool $accepted): self
    {
        $this->accepted = $accepted;

        return $this;
    }
}
