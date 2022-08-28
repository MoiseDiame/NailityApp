<?php

namespace App\Entity;

use App\Repository\ProductAvailablityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductAvailablityRepository::class)
 */
class ProductAvailablity
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
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=Vsp::class, mappedBy="availablity")
     */
    private $vsps;

    public function __construct()
    {
        $this->vsps = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->status;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

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
            $vsp->setAvailablity($this);
        }

        return $this;
    }

    public function removeVsp(Vsp $vsp): self
    {
        if ($this->vsps->removeElement($vsp)) {
            // set the owning side to null (unless already changed)
            if ($vsp->getAvailablity() === $this) {
                $vsp->setAvailablity(null);
            }
        }

        return $this;
    }
}
