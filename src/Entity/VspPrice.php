<?php

namespace App\Entity;

use App\Repository\VspPriceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VspPriceRepository::class)
 */
class VspPrice
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=VspSize::class, inversedBy="vspPrice", cascade={"persist", "remove"})
     */
    private $size;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSize(): ?VspSize
    {
        return $this->size;
    }

    public function setSize(?VspSize $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->Price;
    }

    public function setPrice(string $Price): self
    {
        $this->Price = $Price;

        return $this;
    }
}
