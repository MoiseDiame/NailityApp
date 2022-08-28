<?php

namespace App\Entity;

use App\Repository\VspWeightRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VspWeightRepository::class)
 */
class VspWeight
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=VspSize::class, inversedBy="vspWeight", cascade={"persist", "remove"})
     */
    private $size;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Weight;

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

    public function getWeight(): ?string
    {
        return $this->Weight;
    }

    public function setWeight(string $Weight): self
    {
        $this->Weight = $Weight;

        return $this;
    }
}
