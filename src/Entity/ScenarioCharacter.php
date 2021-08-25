<?php

namespace App\Entity;

use App\Repository\ScenarioCharacterRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ScenarioCharacterRepository::class)
 */
class ScenarioCharacter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Scenario::class, inversedBy="scenarioCharacters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $scenario;

    /**
     * @ORM\ManyToOne(targetEntity=Character::class, inversedBy="scenarioCharacters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $personnage;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAccepted;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScenario(): ?Scenario
    {
        return $this->scenario;
    }

    public function setScenario(?Scenario $scenario): self
    {
        $this->scenario = $scenario;

        return $this;
    }

    public function getPersonnage(): ?Character
    {
        return $this->personnage;
    }

    public function setPersonnage(?Character $personnage): self
    {
        $this->personnage = $personnage;

        return $this;
    }

    public function getIsAccepted(): ?bool
    {
        return $this->isAccepted;
    }

    public function setIsAccepted(bool $isAccepted): self
    {
        $this->isAccepted = $isAccepted;

        return $this;
    }
}
