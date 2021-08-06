<?php

namespace App\Entity;

use App\Repository\SpellRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\ManyToMany(targetEntity=Game::class, mappedBy="spells")
     */
    private $games;

    /**
     * @ORM\OneToMany(targetEntity=CharacterSpell::class, mappedBy="spell")
     */
    private $characterSpells;

    public function __construct()
    {
        $this->games = new ArrayCollection();
        $this->characterSpells = new ArrayCollection();
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

    /**
     * @return Collection|Game[]
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): self
    {
        if (!$this->games->contains($game)) {
            $this->games[] = $game;
            $game->addSpell($this);
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        if ($this->games->removeElement($game)) {
            $game->removeSpell($this);
        }

        return $this;
    }

    /**
     * @return Collection|CharacterSpell[]
     */
    public function getCharacterSpells(): Collection
    {
        return $this->characterSpells;
    }

    public function addCharacterSpell(CharacterSpell $characterSpell): self
    {
        if (!$this->characterSpells->contains($characterSpell)) {
            $this->characterSpells[] = $characterSpell;
            $characterSpell->setSpell($this);
        }

        return $this;
    }

    public function removeCharacterSpell(CharacterSpell $characterSpell): self
    {
        if ($this->characterSpells->removeElement($characterSpell)) {
            // set the owning side to null (unless already changed)
            if ($characterSpell->getSpell() === $this) {
                $characterSpell->setSpell(null);
            }
        }

        return $this;
    }
}
