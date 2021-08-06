<?php

namespace App\Entity;

use App\Repository\CharacterSpellRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CharacterSpellRepository::class)
 */
class CharacterSpell
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Character::class, inversedBy="characterSpells")
     * @ORM\JoinColumn(nullable=false)
     */
    private $characters;

    /**
     * @ORM\ManyToOne(targetEntity=Spell::class, inversedBy="characterSpells")
     * @ORM\JoinColumn(nullable=false)
     */
    private $spell;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $level;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCharacters(): ?Character
    {
        return $this->characters;
    }

    public function setCharacters(?Character $characters): self
    {
        $this->characters = $characters;

        return $this;
    }

    public function getSpell(): ?Spell
    {
        return $this->spell;
    }

    public function setSpell(?Spell $spell): self
    {
        $this->spell = $spell;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(?int $level): self
    {
        $this->level = $level;

        return $this;
    }
}
