<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AuctionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuctionRepository::class)]
#[ApiResource]
class Auction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'end_at')]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $creator = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $end_at = null;

    #[ORM\Column]
    private ?float $startPrice = null;

    #[ORM\Column(nullable: true)]
    private ?float $actualPrice = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreator(): ?user
    {
        return $this->creator;
    }

    public function setCreator(?user $creator): self
    {
        $this->creator = $creator;

        return $this;
    }

    public function getEndAt(): ?\DateTimeImmutable
    {
        return $this->end_at;
    }

    public function setEndAt(\DateTimeImmutable $end_at): self
    {
        $this->end_at = $end_at;

        return $this;
    }

    public function getStartPrice(): ?float
    {
        return $this->startPrice;
    }

    public function setStartPrice(float $startPrice): self
    {
        $this->startPrice = $startPrice;

        return $this;
    }

    public function getActualPrice(): ?float
    {
        return $this->actualPrice;
    }

    public function setActualPrice(?float $actualPrice): self
    {
        $this->actualPrice = $actualPrice;

        return $this;
    }
}
