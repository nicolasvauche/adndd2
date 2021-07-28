<?php

namespace App\Entity;

use App\Repository\SpellRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SpellRepository::class)
 */
class Spell
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $effect;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $reach;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $zone;

    /**
     * @ORM\ManyToOne(targetEntity=SpellType::class, inversedBy="spells")
     */
    private $SpellType;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEffect(): ?string
    {
        return $this->effect;
    }

    public function setEffect(string $effect): self
    {
        $this->effect = $effect;

        return $this;
    }

    public function getReach(): ?int
    {
        return $this->reach;
    }

    public function setReach(?int $reach): self
    {
        $this->reach = $reach;

        return $this;
    }

    public function getZone(): ?int
    {
        return $this->zone;
    }

    public function setZone(?int $zone): self
    {
        $this->zone = $zone;

        return $this;
    }

    public function getSpellType(): ?SpellType
    {
        return $this->SpellType;
    }

    public function setSpellType(?SpellType $SpellType): self
    {
        $this->SpellType = $SpellType;

        return $this;
    }
}
