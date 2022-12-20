<?php

namespace App\Entity;

use App\Repository\MotosPanierRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MotosPanierRepository::class)]
class MotosPanier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $Quantite = null;

    #[ORM\Column]
    private ?int $Total = null;

    #[ORM\Column(length: 255)]
    private ?string $Motos = null;

    #[ORM\Column(length: 255)]
    private ?string $Panier = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->Quantite;
    }

    public function setQuantite(int $Quantite): self
    {
        $this->Quantite = $Quantite;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->Total;
    }

    public function setTotal(int $Total): self
    {
        $this->Total = $Total;

        return $this;
    }

    public function getMotos(): ?string
    {
        return $this->Motos;
    }

    public function setMotos(string $Motos): self
    {
        $this->Motos = $Motos;

        return $this;
    }

    public function getPanier(): ?string
    {
        return $this->Panier;
    }

    public function setPanier(string $Panier): self
    {
        $this->Panier = $Panier;

        return $this;
    }
}
