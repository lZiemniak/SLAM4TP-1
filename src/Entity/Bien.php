<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BienRepository")
 */
class Bien
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_piece;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_chambre;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2)
     */
    private $superficie;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2)
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $chauffage;

    /**
     * @ORM\Column(type="integer")
     */
    private $annee;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $localisation;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Type")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbPiece(): ?int
    {
        return $this->nb_piece;
    }

    public function setNbPiece(int $nb_piece): self
    {
        $this->nb_piece = $nb_piece;

        return $this;
    }

    public function getNbChambre(): ?int
    {
        return $this->nb_chambre;
    }

    public function setNbChambre(int $nb_chambre): self
    {
        $this->nb_chambre = $nb_chambre;

        return $this;
    }

    public function getSuperficie(): ?string
    {
        return $this->superficie;
    }

    public function setSuperficie(string $superficie): self
    {
        $this->superficie = $superficie;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getChauffage(): ?string
    {
        return $this->chauffage;
    }

    public function setChauffage(string $chauffage): self
    {
        $this->chauffage = $chauffage;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }
}
