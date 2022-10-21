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
     * @ORM\OneToMany(targetEntity=Vsp::class, mappedBy="color",cascade={"remove"})
     */
    private $vsps;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="VspColor")
     */
    private $products;

    public function __construct()
    {
        $this->vsps = new ArrayCollection();
        $this->products = new ArrayCollection();
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

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setVspColor($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getVspColor() === $this) {
                $product->setVspColor(null);
            }
        }

        return $this;
    }
}
