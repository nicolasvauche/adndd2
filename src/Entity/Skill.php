<?php

namespace App\Entity;

use App\Repository\SkillRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SkillRepository::class)
 */
class Skill
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
     * @ORM\OneToMany(targetEntity=GameSkill::class, mappedBy="skill")
     */
    private $gameSkills;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=SkillType::class, inversedBy="skills")
     */
    private $skillType;

    /**
     * @ORM\OneToMany(targetEntity=CharacterSkill::class, mappedBy="skill")
     */
    private $characterSkills;

    public function __construct()
    {
        $this->gameSkills = new ArrayCollection();
        $this->characterSkills = new ArrayCollection();
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
     * @return Collection|GameSkill[]
     */
    public function getGameSkills(): Collection
    {
        return $this->gameSkills;
    }

    public function addGameSkill(GameSkill $gameSkill): self
    {
        if (!$this->gameSkills->contains($gameSkill)) {
            $this->gameSkills[] = $gameSkill;
            $gameSkill->setSkill($this);
        }

        return $this;
    }

    public function removeGameSkill(GameSkill $gameSkill): self
    {
        if ($this->gameSkills->removeElement($gameSkill)) {
            // set the owning side to null (unless already changed)
            if ($gameSkill->getSkill() === $this) {
                $gameSkill->setSkill(null);
            }
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSkillType(): ?SkillType
    {
        return $this->skillType;
    }

    public function setSkillType(?SkillType $skillType): self
    {
        $this->skillType = $skillType;

        return $this;
    }

    /**
     * @return Collection|CharacterSkill[]
     */
    public function getCharacterSkills(): Collection
    {
        return $this->characterSkills;
    }

    public function addCharacterSkill(CharacterSkill $characterSkill): self
    {
        if (!$this->characterSkills->contains($characterSkill)) {
            $this->characterSkills[] = $characterSkill;
            $characterSkill->setSkill($this);
        }

        return $this;
    }

    public function removeCharacterSkill(CharacterSkill $characterSkill): self
    {
        if ($this->characterSkills->removeElement($characterSkill)) {
            // set the owning side to null (unless already changed)
            if ($characterSkill->getSkill() === $this) {
                $characterSkill->setSkill(null);
            }
        }

        return $this;
    }
}
