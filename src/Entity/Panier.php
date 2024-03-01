<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Produit;


#[ORM\Entity(repositoryClass: PanierRepository::class)]
class Panier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(targetEntity:Produit::class, cascade:["persist"])]
    private $id_produit = null;

    #[ORM\Column]
    private ?int $nb_produit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdProduit(): ?Produit
    {
        return $this->id_produit;
    }

    public function getNomProduit(): ?string
    {
        return $this->id_produit->getNom();
    }

    public function setIdProduit(Produit $id_produit): static
    {
        $this->id_produit = $id_produit;

        return $this;
    }

    public function getNbProduit(): ?int
    {
        return $this->nb_produit;
    }

    public function setNbProduit(int $nb_produit): static
    {
        $this->nb_produit = $nb_produit;

        return $this;
    }
}
