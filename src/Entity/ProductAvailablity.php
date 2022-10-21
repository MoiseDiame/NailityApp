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


    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="availablity")
     */
    private $products;

    public function __construct()
    {
        $this->vsps = new ArrayCollection();
        $this->electricDevices = new ArrayCollection();
        $this->products = new ArrayCollection();
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
            $product->setAvailablity($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getAvailablity() === $this) {
                $product->setAvailablity(null);
            }
        }

        return $this;
    }
}
