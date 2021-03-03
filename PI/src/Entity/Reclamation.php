<?php

namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReclamationRepository::class)
 */
class Reclamation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Candidat::class, mappedBy="reclamation", orphanRemoval=true)
     */
    private $candidat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Entreprise::class, inversedBy="reclamations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entreprise;

    /**
     * @ORM\ManyToOne(targetEntity=Blame::class, inversedBy="reclamation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $blame;

    public function __construct()
    {
        $this->candidat = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|candidat[]
     */
    public function getCandidat(): Collection
    {
        return $this->candidat;
    }

    public function addCandidat(candidat $candidat): self
    {
        if (!$this->candidat->contains($candidat)) {
            $this->candidat[] = $candidat;
            $candidat->setReclamation($this);
        }

        return $this;
    }

    public function removeCandidat(candidat $candidat): self
    {
        if ($this->candidat->removeElement($candidat)) {
            // set the owning side to null (unless already changed)
            if ($candidat->getReclamation() === $this) {
                $candidat->setReclamation(null);
            }
        }

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getEntreprise(): ?entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getBlame(): ?Blame
    {
        return $this->blame;
    }

    public function setBlame(?Blame $blame): self
    {
        $this->blame = $blame;

        return $this;
    }
}
