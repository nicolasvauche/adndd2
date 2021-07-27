<?php

namespace App\Entity;

use App\Repository\DicesetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DicesetRepository::class)
 */
class Diceset
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
     * @ORM\OneToMany(targetEntity=GameSystem::class, mappedBy="diceset")
     */
    private $gameSystem;

    /**
     * @ORM\ManyToMany(targetEntity=Dice::class, inversedBy="dicesets")
     */
    private $dices;

    public function __construct()
    {
        $this->gameSystem = new ArrayCollection();
        $this->dices = new ArrayCollection();
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

    /**
     * @return Collection|GameSystem[]
     */
    public function getGameSystem(): Collection
    {
        return $this->gameSystem;
    }

    public function addGameSystem(GameSystem $gameSystem): self
    {
        if (!$this->gameSystem->contains($gameSystem)) {
            $this->gameSystem[] = $gameSystem;
            $gameSystem->setDiceset($this);
        }

        return $this;
    }

    public function removeGameSystem(GameSystem $gameSystem): self
    {
        if ($this->gameSystem->removeElement($gameSystem)) {
            // set the owning side to null (unless already changed)
            if ($gameSystem->getDiceset() === $this) {
                $gameSystem->setDiceset(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Dice[]
     */
    public function getDices(): Collection
    {
        return $this->dices;
    }

    public function addDice(Dice $dice): self
    {
        if (!$this->dices->contains($dice)) {
            $this->dices[] = $dice;
        }

        return $this;
    }

    public function removeDice(Dice $dice): self
    {
        $this->dices->removeElement($dice);

        return $this;
    }
}
