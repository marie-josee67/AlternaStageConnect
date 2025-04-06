<?php

namespace App\Entity;

use App\Repository\AlternanceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlternanceRepository::class)]
class Alternance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $metier = null;

    #[ORM\Column(length: 100)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_creat = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_debut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_fin = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_ouverture = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_cloture = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $mission = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $processus = null;

    #[ORM\Column]
    private ?int $annee_experience = null;

    #[ORM\Column(nullable: true)]
    private ?bool $reconversible = null;

    #[ORM\Column(length: 255)]
    private ?string $img = null;

    #[ORM\ManyToOne(inversedBy: 'alternances')]
    private ?Metier $Alternance = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMetier(): ?string
    {
        return $this->metier;
    }

    public function setMetier(string $metier): static
    {
        $this->metier = $metier;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDateCreat(): ?\DateTimeInterface
    {
        return $this->date_creat;
    }

    public function setDateCreat(\DateTimeInterface $date_creat): static
    {
        $this->date_creat = $date_creat;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): static
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): static
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getDateOuverture(): ?\DateTimeInterface
    {
        return $this->date_ouverture;
    }

    public function setDateOuverture(?\DateTimeInterface $date_ouverture): static
    {
        $this->date_ouverture = $date_ouverture;

        return $this;
    }

    public function getDateCloture(): ?\DateTimeInterface
    {
        return $this->date_cloture;
    }

    public function setDateCloture(?\DateTimeInterface $date_cloture): static
    {
        $this->date_cloture = $date_cloture;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getMission(): ?string
    {
        return $this->mission;
    }

    public function setMission(string $mission): static
    {
        $this->mission = $mission;

        return $this;
    }

    public function getProcessus(): ?string
    {
        return $this->processus;
    }

    public function setProcessus(?string $processus): static
    {
        $this->processus = $processus;

        return $this;
    }

    public function getAnneeExperience(): ?int
    {
        return $this->annee_experience;
    }

    public function setAnneeExperience(int $annee_experience): static
    {
        $this->annee_experience = $annee_experience;

        return $this;
    }

    public function isReconversible(): ?bool
    {
        return $this->reconversible;
    }

    public function setReconversible(?bool $reconversible): static
    {
        $this->reconversible = $reconversible;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): static
    {
        $this->img = $img;

        return $this;
    }

    public function getAlternance(): ?Metier
    {
        return $this->Alternance;
    }

    public function setAlternance(?Metier $Alternance): static
    {
        $this->Alternance = $Alternance;

        return $this;
    }
}
