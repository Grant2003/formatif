<?php

namespace App\Entity;

use App\Repository\RepartitionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RepartitionRepository::class)]
class Repartition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $horodateur = null;

    #[ORM\ManyToOne(inversedBy: 'repartitions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?vehicule $vehicule = null;

    #[ORM\ManyToOne(inversedBy: 'repartitions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Intervention $intervention = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHorodateur(): ?\DateTime
    {
        return $this->horodateur;
    }

    public function setHorodateur(\DateTime $horodateur): static
    {
        $this->horodateur = $horodateur;

        return $this;
    }

    public function getVehicule(): ?vehicule
    {
        return $this->vehicule;
    }

    public function setVehicule(?vehicule $vehicule): static
    {
        $this->vehicule = $vehicule;

        return $this;
    }

    public function getIntervention(): ?Intervention
    {
        return $this->intervention;
    }

    public function setIntervention(?Intervention $intervention): static
    {
        $this->intervention = $intervention;

        return $this;
    }
}
