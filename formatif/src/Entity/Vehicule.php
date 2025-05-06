<?php

namespace App\Entity;

use App\Repository\VehiculeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehiculeRepository::class)]
class Vehicule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $metricule = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    /**
     * @var Collection<int, Repartition>
     */
    #[ORM\OneToMany(targetEntity: Repartition::class, mappedBy: 'vehicule')]
    private Collection $repartitions;

    public function __construct()
    {
        $this->repartitions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMetricule(): ?string
    {
        return $this->metricule;
    }

    public function setMetricule(string $metricule): static
    {
        $this->metricule = $metricule;

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

    /**
     * @return Collection<int, Repartition>
     */
    public function getRepartitions(): Collection
    {
        return $this->repartitions;
    }

    public function addRepartition(Repartition $repartition): static
    {
        if (!$this->repartitions->contains($repartition)) {
            $this->repartitions->add($repartition);
            $repartition->setVehicule($this);
        }

        return $this;
    }

    public function removeRepartition(Repartition $repartition): static
    {
        if ($this->repartitions->removeElement($repartition)) {
            // set the owning side to null (unless already changed)
            if ($repartition->getVehicule() === $this) {
                $repartition->setVehicule(null);
            }
        }

        return $this;
    }
}
