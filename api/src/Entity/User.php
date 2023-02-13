<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ApiResource]

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 180, unique: true)]
    private string $name;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $postalAddress = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phoneNumber = null;

    #[ORM\Column(nullable: true)]
    private ?int $postalCode = null;

    #[ORM\ManyToOne(inversedBy: 'owner')]
    private ?Items $items = null;

    #[ORM\OneToMany(mappedBy: 'sold', targetEntity: Items::class)]
    private Collection $itemsold;

    #[ORM\OneToMany(mappedBy: 'itemOwner', targetEntity: Items::class)]
    private Collection $ownerItems;

    #[ORM\OneToMany(mappedBy: 'whoUser', targetEntity: Demande::class, orphanRemoval: true)]
    private Collection $demandes;

    public function __construct()
    {
        $this->itemsold = new ArrayCollection();
        $this->ownerItems = new ArrayCollection();
        $this->demandes = new ArrayCollection();
    }

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPostalAddress(): ?string
    {
        return $this->postalAddress;
    }

    public function setPostalAddress(?string $postalAddress): self
    {
        $this->postalAddress = $postalAddress;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    public function setPostalCode(?int $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getItems(): ?Items
    {
        return $this->items;
    }

    public function setItems(?Items $items): self
    {
        $this->items = $items;

        return $this;
    }

    /**
     * @return Collection<int, Items>
     */
    public function getItemsold(): Collection
    {
        return $this->itemsold;
    }

    public function addItemsold(Items $itemsold): self
    {
        if (!$this->itemsold->contains($itemsold)) {
            $this->itemsold->add($itemsold);
            $itemsold->setSold($this);
        }

        return $this;
    }

    public function removeItemsold(Items $itemsold): self
    {
        if ($this->itemsold->removeElement($itemsold)) {
            // set the owning side to null (unless already changed)
            if ($itemsold->getSold() === $this) {
                $itemsold->setSold(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Items>
     */
    public function getOwnerItems(): Collection
    {
        return $this->ownerItems;
    }

    public function addOwnerItem(Items $ownerItem): self
    {
        if (!$this->ownerItems->contains($ownerItem)) {
            $this->ownerItems->add($ownerItem);
            $ownerItem->setItemOwner($this);
        }

        return $this;
    }

    public function removeOwnerItem(Items $ownerItem): self
    {
        if ($this->ownerItems->removeElement($ownerItem)) {
            // set the owning side to null (unless already changed)
            if ($ownerItem->getItemOwner() === $this) {
                $ownerItem->setItemOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Demande>
     */
    public function getDemandes(): Collection
    {
        return $this->demandes;
    }

    public function addDemande(Demande $demande): self
    {
        if (!$this->demandes->contains($demande)) {
            $this->demandes->add($demande);
            $demande->setWhoUser($this);
        }

        return $this;
    }

    public function removeDemande(Demande $demande): self
    {
        if ($this->demandes->removeElement($demande)) {
            // set the owning side to null (unless already changed)
            if ($demande->getWhoUser() === $this) {
                $demande->setWhoUser(null);
            }
        }

        return $this;
    }
}
