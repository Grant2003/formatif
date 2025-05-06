<?php

namespace App\Entity;

use App\Repository\InterventionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InterventionRepository::class)]
class Intervention
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $adresse = null;

    #[ORM\Column(length: 20)]
    private ?string $type = null;

    /**
     * @var Collection<int, Repartition>
     */
    #[ORM\OneToMany(targetEntity: Repartition::class, mappedBy: 'intervention')]
    private Collection $repartitions;

    public function __construct()
    {
        $this->repartitions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

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
            $repartition->setIntervention($this);
        }

        return $this;
    }

    public function removeRepartition(Repartition $repartition): static
    {
        if ($this->repartitions->removeElement($repartition)) {
            // set the owning side to null (unless already changed)
            if ($repartition->getIntervention() === $this) {
                $repartition->setIntervention(null);
            }
        }

        return $this;
    }
}
