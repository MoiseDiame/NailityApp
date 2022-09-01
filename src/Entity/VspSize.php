<?php

namespace App\Entity;

use App\Repository\VspSizeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VspSizeRepository::class)
 */
class VspSize
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
    private $size;

    /**
     * @ORM\OneToOne(targetEntity=VspPrice::class, mappedBy="size", cascade={"persist", "remove"})
     */
    private $vspPrice;

    /**
     * @ORM\OneToOne(targetEntity=VspWeight::class, mappedBy="size", cascade={"persist", "remove"})
     */
    private $vspWeight;

    public function __toString()
    {
        return $this->size;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getVspPrice(): ?VspPrice
    {
        return $this->vspPrice;
    }

    public function setVspPrice(?VspPrice $vspPrice): self
    {
        // unset the owning side of the relation if necessary
        if ($vspPrice === null && $this->vspPrice !== null) {
            $this->vspPrice->setSize(null);
        }

        // set the owning side of the relation if necessary
        if ($vspPrice !== null && $vspPrice->getSize() !== $this) {
            $vspPrice->setSize($this);
        }

        $this->vspPrice = $vspPrice;

        return $this;
    }

    public function getVspWeight(): ?VspWeight
    {
        return $this->vspWeight;
    }

    public function setVspWeight(?VspWeight $vspWeight): self
    {
        // unset the owning side of the relation if necessary
        if ($vspWeight === null && $this->vspWeight !== null) {
            $this->vspWeight->setSize(null);
        }

        // set the owning side of the relation if necessary
        if ($vspWeight !== null && $vspWeight->getSize() !== $this) {
            $vspWeight->setSize($this);
        }

        $this->vspWeight = $vspWeight;

        return $this;
    }
}
