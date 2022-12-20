<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PanierRepository::class)]
class Panier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $DatePanier = null;

    #[ORM\Column]
    private ?int $Total = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Users $Users = null;

    #[ORM\OneToMany(mappedBy: 'Panier', targetEntity: Photos::class)]
    private Collection $photos;

    public function __construct()
    {
        $this->photos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatePanier(): ?\DateTimeInterface
    {
        return $this->DatePanier;
    }

    public function setDatePanier(\DateTimeInterface $DatePanier): self
    {
        $this->DatePanier = $DatePanier;

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

    public function getUsers(): ?string
    {
        return $this->Users;
    }

    public function setUsers(string $Users): self
    {
        $this->Users = $Users;

        return $this;
    }

    /**
     * @return Collection<int, Photos>
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photos $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos->add($photo);
            $photo->setPanier($this);
        }

        return $this;
    }

    public function removePhoto(Photos $photo): self
    {
        if ($this->photos->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getPanier() === $this) {
                $photo->setPanier(null);
            }
        }

        return $this;
    }
}
