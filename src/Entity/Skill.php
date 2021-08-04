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

    public function __construct()
    {
        $this->gameSkills = new ArrayCollection();
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
}
