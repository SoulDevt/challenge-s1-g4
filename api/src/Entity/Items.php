<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ItemsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemsRepository::class)]
#[ApiResource]
class Items
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?int $price = null;

    #[ORM\OneToMany(mappedBy: 'items', targetEntity: User::class)]
    private Collection $owner;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $pictures = [];

    #[ORM\ManyToOne(inversedBy: 'itemsold')]
    private ?User $sold = null;

    public function __construct()
    {
        $this->owner = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getOwner(): Collection
    {
        return $this->owner;
    }

    public function addOwner(User $owner): self
    {
        if (!$this->owner->contains($owner)) {
            $this->owner->add($owner);
            $owner->setItems($this);
        }

        return $this;
    }

    public function removeOwner(User $owner): self
    {
        if ($this->owner->removeElement($owner)) {
            // set the owning side to null (unless already changed)
            if ($owner->getItems() === $this) {
                $owner->setItems(null);
            }
        }

        return $this;
    }

    public function getPictures(): array
    {
        return $this->pictures;
    }

    public function setPictures(?array $pictures): self
    {
        $this->pictures = $pictures;

        return $this;
    }

    public function getSold(): ?User
    {
        return $this->sold;
    }

    public function setSold(?User $sold): self
    {
        $this->sold = $sold;

        return $this;
    }
}
