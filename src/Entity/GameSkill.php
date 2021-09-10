<?php

namespace App\Entity;

use App\Repository\GameSkillRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameSkillRepository::class)
 */
class GameSkill
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Game::class, inversedBy="gameSkills")
     * @ORM\JoinColumn(nullable=false)
     */
    private $game;

    /**
     * @ORM\ManyToOne(targetEntity=Skill::class, inversedBy="gameSkills")
     * @ORM\JoinColumn(nullable=false)
     */
    private $skill;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $base;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): self
    {
        $this->game = $game;

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

    public function getBase(): ?string
    {
        return $this->base;
    }

    public function setBase(?string $base): self
    {
        $this->base = $base;

        return $this;
    }
}
