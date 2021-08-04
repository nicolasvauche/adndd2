<?php

namespace App\Entity;

use App\Repository\DiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DiceRepository::class)
 */
class Dice
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
     * @ORM\Column(type="integer")
     */
    private $faces;

    /**
     * @ORM\ManyToMany(targetEntity=Diceset::class, mappedBy="dices")
     */
    private $dicesets;

    public function __construct()
    {
        $this->dicesets = new ArrayCollection();
    }

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

    public function getFaces(): ?int
    {
        return $this->faces;
    }

    public function setFaces(int $faces): self
    {
        $this->faces = $faces;

        return $this;
    }

    /**
     * @return Collection|Diceset[]
     */
    public function getDicesets(): Collection
    {
        return $this->dicesets;
    }

    public function addDiceset(Diceset $diceset): self
    {
        if (!$this->dicesets->contains($diceset)) {
            $this->dicesets[] = $diceset;
            $diceset->addDice($this);
        }

        return $this;
    }

    public function removeDiceset(Diceset $diceset): self
    {
        if ($this->dicesets->removeElement($diceset)) {
            $diceset->removeDice($this);
        }

        return $this;
    }
}
