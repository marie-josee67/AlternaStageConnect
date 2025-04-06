<?php

namespace App\Entity;

use App\Repository\CompetencesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompetencesRepository::class)]
class Competences
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    /**
     * @var Collection<int, Alternance>
     */
    #[ORM\ManyToMany(targetEntity: Alternance::class, inversedBy: 'competences')]
    private Collection $Competences;

    /**
     * @var Collection<int, Stage>
     */
    #[ORM\ManyToMany(targetEntity: Stage::class, inversedBy: 'competences')]
    private Collection $Stage;

    public function __construct()
    {
        $this->Competences = new ArrayCollection();
        $this->Stage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Alternance>
     */
    public function getCompetences(): Collection
    {
        return $this->Competences;
    }

    public function addCompetence(Alternance $competence): static
    {
        if (!$this->Competences->contains($competence)) {
            $this->Competences->add($competence);
        }

        return $this;
    }

    public function removeCompetence(Alternance $competence): static
    {
        $this->Competences->removeElement($competence);

        return $this;
    }

    /**
     * @return Collection<int, Stage>
     */
    public function getStage(): Collection
    {
        return $this->Stage;
    }

    public function addStage(Stage $stage): static
    {
        if (!$this->Stage->contains($stage)) {
            $this->Stage->add($stage);
        }

        return $this;
    }

    public function removeStage(Stage $stage): static
    {
        $this->Stage->removeElement($stage);

        return $this;
    }
}
