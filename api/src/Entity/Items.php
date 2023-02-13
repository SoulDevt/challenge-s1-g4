<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ItemsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiProperty;


#[ORM\Entity(repositoryClass: ItemsRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['items_read']])]
class Items
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('items_read')]
    private ?int $id = null;

    #[Groups('items_read')]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[Groups('items_read')]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[Groups('items_read')]
    #[ORM\Column(nullable: true)]
    private ?int $price = null;

    #[Groups('items_read')]
    #[ORM\ManyToOne(inversedBy: 'itemsold')]
    private ?User $sold = null;

    #[Groups('items_read')]
    #[ORM\OneToMany(mappedBy: 'items', targetEntity: MediaObject::class)]
    private Collection $images;

    #[Groups('items_read')]

    #[ORM\ManyToOne(inversedBy: 'ownerItems')]
    private ?User $itemOwner = null;

    #[Groups('items_read')]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $stripe_price_id = null;


    public function __construct()
    {
        $this->owner = new ArrayCollection();
        $this->images = new ArrayCollection();
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

    public function getSold(): ?User
    {
        return $this->sold;
    }

    public function setSold(?User $sold): self
    {
        $this->sold = $sold;

        return $this;
    }

    /**
     * @return Collection<int, MediaObject>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(MediaObject $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setItems($this);
        }

        return $this;
    }

    public function removeImage(MediaObject $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getItems() === $this) {
                $image->setItems(null);
            }
        }

        return $this;
    }

    public function getItemOwner(): ?User
    {
        return $this->itemOwner;
    }

    public function setItemOwner(?User $itemOwner): self
    {
        $this->itemOwner = $itemOwner;
        return $this;
    }

    public function getStripePriceId(): ?string
    {
        return $this->stripe_price_id;
    }

    public function setStripePriceId(?string $stripe_price_id): self
    {
        $this->stripe_price_id = $stripe_price_id;

        return $this;
    }
}
