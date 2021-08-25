<?php

namespace App\Entity;

use App\Repository\CharacteristicRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CharacteristicRepository::class)
 */
class Characteristic
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
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $shortName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=GameCharacteristic::class, mappedBy="characteristic")
     */
    private $gameCharacteristics;

    /**
     * @ORM\OneToMany(targetEntity=CharacterCharacteristic::class, mappedBy="characteristic")
     */
    private $characterCharacteristics;

    public function __construct()
    {
        $this->gameCharacteristics = new ArrayCollection();
        $this->characterCharacteristics = new ArrayCollection();
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

    public function getShortName(): ?string
    {
        return $this->shortName;
    }

    public function setShortName(string $shortName): self
    {
        $this->shortName = $shortName;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|GameCharacteristic[]
     */
    public function getGameCharacteristics(): Collection
    {
        return $this->gameCharacteristics;
    }

    public function addGameCharacteristic(GameCharacteristic $gameCharacteristic): self
    {
        if (!$this->gameCharacteristics->contains($gameCharacteristic)) {
            $this->gameCharacteristics[] = $gameCharacteristic;
            $gameCharacteristic->setCharacteristic($this);
        }

        return $this;
    }

    public function removeGameCharacteristic(GameCharacteristic $gameCharacteristic): self
    {
        if ($this->gameCharacteristics->removeElement($gameCharacteristic)) {
            // set the owning side to null (unless already changed)
            if ($gameCharacteristic->getCharacteristic() === $this) {
                $gameCharacteristic->setCharacteristic(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CharacterCharacteristic[]
     */
    public function getCharacterCharacteristics(): Collection
    {
        return $this->characterCharacteristics;
    }

    public function addCharacterCharacteristic(CharacterCharacteristic $characterCharacteristic): self
    {
        if (!$this->characterCharacteristics->contains($characterCharacteristic)) {
            $this->characterCharacteristics[] = $characterCharacteristic;
            $characterCharacteristic->setCharacteristic($this);
        }

        return $this;
    }

    public function removeCharacterCharacteristic(CharacterCharacteristic $characterCharacteristic): self
    {
        if ($this->characterCharacteristics->removeElement($characterCharacteristic)) {
            // set the owning side to null (unless already changed)
            if ($characterCharacteristic->getCharacteristic() === $this) {
                $characterCharacteristic->setCharacteristic(null);
            }
        }

        return $this;
    }
}
