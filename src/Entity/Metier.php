<?php

namespace App\Entity;

use App\Repository\MetierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MetierRepository::class)]
class Metier
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
    #[ORM\OneToMany(targetEntity: Alternance::class, mappedBy: 'Alternance')]
    private Collection $alternances;

    /**
     * @var Collection<int, Stage>
     */
    #[ORM\OneToMany(targetEntity: Stage::class, mappedBy: 'Stage')]
    private Collection $stages;

    public function __construct()
    {
        $this->alternances = new ArrayCollection();
        $this->stages = new ArrayCollection();
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
    public function getAlternances(): Collection
    {
        return $this->alternances;
    }

    public function addAlternance(Alternance $alternance): static
    {
        if (!$this->alternances->contains($alternance)) {
            $this->alternances->add($alternance);
            $alternance->setAlternance($this);
        }

        return $this;
    }

    public function removeAlternance(Alternance $alternance): static
    {
        if ($this->alternances->removeElement($alternance)) {
            // set the owning side to null (unless already changed)
            if ($alternance->getAlternance() === $this) {
                $alternance->setAlternance(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Stage>
     */
    public function getStages(): Collection
    {
        return $this->stages;
    }

    public function addStage(Stage $stage): static
    {
        if (!$this->stages->contains($stage)) {
            $this->stages->add($stage);
            $stage->setStage($this);
        }

        return $this;
    }

    public function removeStage(Stage $stage): static
    {
        if ($this->stages->removeElement($stage)) {
            // set the owning side to null (unless already changed)
            if ($stage->getStage() === $this) {
                $stage->setStage(null);
            }
        }

        return $this;
    }
}
