<?php

namespace App\Entity;

use App\Repository\VspColorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VspColorRepository::class)
 */
class VspColor
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
    private $color;

    /**
     * @ORM\OneToMany(targetEntity=Vsp::class, mappedBy="color")
     */
    private $vsps;

    public function __construct()
    {
        $this->vsps = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->color;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return Collection<int, Vsp>
     */
    public function getVsps(): Collection
    {
        return $this->vsps;
    }

    public function addVsp(Vsp $vsp): self
    {
        if (!$this->vsps->contains($vsp)) {
            $this->vsps[] = $vsp;
            $vsp->setColor($this);
        }

        return $this;
    }

    public function removeVsp(Vsp $vsp): self
    {
        if ($this->vsps->removeElement($vsp)) {
            // set the owning side to null (unless already changed)
            if ($vsp->getColor() === $this) {
                $vsp->setColor(null);
            }
        }

        return $this;
    }
}
