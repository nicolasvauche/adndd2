<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
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
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $version;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $shortDescription;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $media;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\ManyToOne(targetEntity=GameCategory::class, inversedBy="games")
     * @ORM\JoinColumn(nullable=false)
     */
    private $gameCategory;

    /**
     * @ORM\OneToMany(targetEntity=GameRules::class, mappedBy="game")
     */
    private $gameRules;

    /**
     * @ORM\ManyToOne(targetEntity=GameSystem::class, inversedBy="games")
     * @ORM\JoinColumn(nullable=false)
     */
    private $gameSystem;

    /**
     * @ORM\OneToMany(targetEntity=Scenario::class, mappedBy="game")
     */
    private $scenarios;

    /**
     * @ORM\ManyToMany(targetEntity=Spell::class, inversedBy="games")
     */
    private $spells;

    /**
     * @ORM\OneToMany(targetEntity=GameSkill::class, mappedBy="game")
     */
    private $gameSkills;

    /**
     * @ORM\OneToMany(targetEntity=GameCharacteristic::class, mappedBy="game")
     */
    private $gameCharacteristics;

    /**
     * @ORM\ManyToMany(targetEntity=Tribe::class, inversedBy="games")
     */
    private $tribes;

    /**
     * @ORM\ManyToMany(targetEntity=Specialty::class, inversedBy="games")
     */
    private $specialties;

    /**
     * @ORM\ManyToMany(targetEntity=Equipment::class, inversedBy="games")
     */
    private $equipments;

    /**
     * @ORM\OneToMany(targetEntity=Character::class, mappedBy="game")
     */
    private $characters;

    /**
     * @ORM\OneToMany(targetEntity=Campaign::class, mappedBy="game")
     */
    private $campaigns;

    public function __construct()
    {
        $this->gameRules = new ArrayCollection();
        $this->scenarios = new ArrayCollection();
        $this->Spells = new ArrayCollection();
        $this->gameSkills = new ArrayCollection();
        $this->gameCharacteristics = new ArrayCollection();
        $this->tribes = new ArrayCollection();
        $this->specialties = new ArrayCollection();
        $this->equipments = new ArrayCollection();
        $this->characters = new ArrayCollection();
        $this->campaigns = new ArrayCollection();
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(?string $version): self
    {
        $this->version = $version;

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

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(?string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getMedia(): ?string
    {
        return $this->media;
    }

    public function setMedia(?string $media): self
    {
        $this->media = $media;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getGameCategory(): ?GameCategory
    {
        return $this->gameCategory;
    }

    public function setGameCategory(?GameCategory $gameCategory): self
    {
        $this->gameCategory = $gameCategory;

        return $this;
    }

    /**
     * @return Collection|GameRules[]
     */
    public function getGameRules(): Collection
    {
        return $this->gameRules;
    }

    public function addGameRule(GameRules $gameRule): self
    {
        if (!$this->gameRules->contains($gameRule)) {
            $this->gameRules[] = $gameRule;
            $gameRule->setGame($this);
        }

        return $this;
    }

    public function removeGameRule(GameRules $gameRule): self
    {
        if ($this->gameRules->removeElement($gameRule)) {
            // set the owning side to null (unless already changed)
            if ($gameRule->getGame() === $this) {
                $gameRule->setGame(null);
            }
        }

        return $this;
    }

    public function getGameSystem(): ?GameSystem
    {
        return $this->gameSystem;
    }

    public function setGameSystem(?GameSystem $gameSystem): self
    {
        $this->gameSystem = $gameSystem;

        return $this;
    }

    /**
     * @return Collection|Scenario[]
     */
    public function getScenarios(): Collection
    {
        return $this->scenarios;
    }

    public function addScenario(Scenario $scenario): self
    {
        if (!$this->scenarios->contains($scenario)) {
            $this->scenarios[] = $scenario;
            $scenario->setGame($this);
        }

        return $this;
    }

    public function removeScenario(Scenario $scenario): self
    {
        if ($this->scenarios->removeElement($scenario)) {
            // set the owning side to null (unless already changed)
            if ($scenario->getGame() === $this) {
                $scenario->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|spell[]
     */
    public function getSpells(): Collection
    {
        return $this->spells;
    }

    public function addSpell(Spell $spell): self
    {
        if (!$this->spells->contains($spell)) {
            $this->spells[] = $spell;
        }

        return $this;
    }

    public function removeSpell(Spell $spell): self
    {
        $this->spells->removeElement($spell);

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
            $gameSkill->setGame($this);
        }

        return $this;
    }

    public function removeGameSkill(GameSkill $gameSkill): self
    {
        if ($this->gameSkills->removeElement($gameSkill)) {
            // set the owning side to null (unless already changed)
            if ($gameSkill->getGame() === $this) {
                $gameSkill->setGame(null);
            }
        }

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
            $gameCharacteristic->setGame($this);
        }

        return $this;
    }

    public function removeGameCharacteristic(GameCharacteristic $gameCharacteristic): self
    {
        if ($this->gameCharacteristics->removeElement($gameCharacteristic)) {
            // set the owning side to null (unless already changed)
            if ($gameCharacteristic->getGame() === $this) {
                $gameCharacteristic->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tribe[]
     */
    public function getTribes(): Collection
    {
        return $this->tribes;
    }

    public function addTribe(Tribe $tribe): self
    {
        if (!$this->tribes->contains($tribe)) {
            $this->tribes[] = $tribe;
        }

        return $this;
    }

    public function removeTribe(Tribe $tribe): self
    {
        $this->tribes->removeElement($tribe);

        return $this;
    }

    /**
     * @return Collection|Specialty[]
     */
    public function getSpecialties(): Collection
    {
        return $this->specialties;
    }

    public function addSpecialty(Specialty $specialty): self
    {
        if (!$this->specialties->contains($specialty)) {
            $this->specialties[] = $specialty;
        }

        return $this;
    }

    public function removeSpecialty(Specialty $specialty): self
    {
        $this->specialties->removeElement($specialty);

        return $this;
    }

    /**
     * @return Collection|Equipment[]
     */
    public function getEquipments(): Collection
    {
        return $this->equipments;
    }

    public function addEquipment(Equipment $equipment): self
    {
        if (!$this->equipments->contains($equipment)) {
            $this->equipments[] = $equipment;
        }

        return $this;
    }

    public function removeEquipment(Equipment $equipment): self
    {
        $this->equipments->removeElement($equipment);

        return $this;
    }

    /**
     * @return Collection|Character[]
     */
    public function getCharacters(): Collection
    {
        return $this->characters;
    }

    public function addCharacter(Character $character): self
    {
        if (!$this->characters->contains($character)) {
            $this->characters[] = $character;
            $character->setGame($this);
        }

        return $this;
    }

    public function removeCharacter(Character $character): self
    {
        if ($this->characters->removeElement($character)) {
            // set the owning side to null (unless already changed)
            if ($character->getGame() === $this) {
                $character->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Campaign[]
     */
    public function getCampaigns(): Collection
    {
        return $this->campaigns;
    }

    public function addCampaign(Campaign $campaign): self
    {
        if (!$this->campaigns->contains($campaign)) {
            $this->campaigns[] = $campaign;
            $campaign->setGame($this);
        }

        return $this;
    }

    public function removeCampaign(Campaign $campaign): self
    {
        if ($this->campaigns->removeElement($campaign)) {
            // set the owning side to null (unless already changed)
            if ($campaign->getGame() === $this) {
                $campaign->setGame(null);
            }
        }

        return $this;
    }
}
