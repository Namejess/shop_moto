<?php

namespace App\Entity;

use App\Repository\CommandesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandesRepository::class)]
class Commandes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $DateCommande = null;

    #[ORM\Column]
    private ?int $Total = null;

    #[ORM\Column]
    private ?bool $Payee = null;

    #[ORM\Column(length: 255)]
    private ?string $Retrait = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Panier $Panier = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?Users $Users = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?Adresse $AdresseFacture = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?Adresse $AdresseLivraison = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCommande(): ?int
    {
        return $this->DateCommande;
    }

    public function setDateCommande(int $DateCommande): self
    {
        $this->DateCommande = $DateCommande;

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

    public function isPayee(): ?bool
    {
        return $this->Payee;
    }

    public function setPayee(bool $Payee): self
    {
        $this->Payee = $Payee;

        return $this;
    }

    public function getRetrait(): ?string
    {
        return $this->Retrait;
    }

    public function setRetrait(string $Retrait): self
    {
        $this->Retrait = $Retrait;

        return $this;
    }

    public function getPanier(): ?Panier
    {
        return $this->Panier;
    }

    public function setPanier(?Panier $Panier): self
    {
        $this->Panier = $Panier;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->Users;
    }

    public function setUsers(?Users $Users): self
    {
        $this->Users = $Users;

        return $this;
    }

    public function getAdresseFacture(): ?Adresse
    {
        return $this->AdresseFacture;
    }

    public function setAdresseFacture(?Adresse $AdresseFacture): self
    {
        $this->AdresseFacture = $AdresseFacture;

        return $this;
    }

    public function getAdresseLivraison(): ?Adresse
    {
        return $this->AdresseLivraison;
    }

    public function setAdresseLivraison(?Adresse $AdresseLivraison): self
    {
        $this->AdresseLivraison = $AdresseLivraison;

        return $this;
    }
}
