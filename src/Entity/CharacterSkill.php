<?php

namespace App\Entity;

use App\Repository\CharacterSkillRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CharacterSkillRepository::class)
 */
class CharacterSkill
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Character::class, inversedBy="characterSkills")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $character;

    /**
     * @ORM\ManyToOne(targetEntity=Skill::class, inversedBy="characterSkills")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $skill;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $base;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCharacter(): ?Character
    {
        return $this->character;
    }

    public function setCharacter(?Character $character): self
    {
        $this->character = $character;

        return $this;
    }

    public function getSkill(): ?Skill
    {
        return $this->skill;
    }

    public function setSkill(?Skill $skill): self
    {
        $this->skill = $skill;

        return $this;
    }

    public function getBase(): ?int
    {
        return $this->base;
    }

    public function setBase(?int $base): self
    {
        $this->base = $base;

        return $this;
    }
}
