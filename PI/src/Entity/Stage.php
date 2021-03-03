<?php

namespace App\Entity;

use App\Repository\StageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StageRepository::class)
 */
class Stage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $duree;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type_du_stage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_encadrant;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getTypeDuStage(): ?string
    {
        return $this->type_du_stage;
    }

    public function setTypeDuStage(string $type_du_stage): self
    {
        $this->type_du_stage = $type_du_stage;

        return $this;
    }

    public function getNomEncadrant(): ?string
    {
        return $this->nom_encadrant;
    }

    public function setNomEncadrant(string $nom_encadrant): self
    {
        $this->nom_encadrant = $nom_encadrant;

        return $this;
    }
}
