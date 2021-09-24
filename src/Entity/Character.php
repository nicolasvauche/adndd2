<?php

namespace App\Entity;

use App\Repository\CharacterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CharacterRepository::class)
 * @ORM\Table(name="`character`")
 */
class Character
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatar;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $guidingHand;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $size;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $weight;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $age;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $distinctive;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $occupation;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $story;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $notes;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPremade;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $birthplace;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $homeplace;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $relatives;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $allegiance;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $coinpurse;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="characters")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Game::class, inversedBy="characters")
     */
    private $game;

    /**
     * @ORM\ManyToOne(targetEntity=Tribe::class, inversedBy="characters")
     */
    private $tribe;

    /**
     * @ORM\OneToMany(targetEntity=CharacterSpell::class, mappedBy="character")
     */
    private $characterSpells;

    /**
     * @ORM\OneToMany(targetEntity=CharacterCharacteristic::class, mappedBy="character")
     */
    private $characterCharacteristics;

    /**
     * @ORM\OneToMany(targetEntity=CharacterSkill::class, mappedBy="character")
     */
    private $characterSkills;

    /**
     * @ORM\ManyToMany(targetEntity=Equipment::class, mappedBy="characters")
     */
    private $equipments;

    /**
     * @ORM\ManyToMany(targetEntity=Specialty::class, mappedBy="characters")
     */
    private $specialties;

    /**
     * @ORM\OneToMany(targetEntity=ScenarioCharacter::class, mappedBy="personnage", orphanRemoval=true)
     */
    private $scenarioCharacters;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $chaos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $balance;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $loi;

    public function __construct()
    {
        $this->characterSpells = new ArrayCollection();
        $this->characterCharacteristics = new ArrayCollection();
        $this->characterSkills = new ArrayCollection();
        $this->equipments = new ArrayCollection();
        $this->specialties = new ArrayCollection();
        $this->scenarioCharacters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        if ($avatar) {
            $this->avatar = $avatar;
        }

        return $this;
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

    public function getFullname(): ?string
    {
        return $this->name . ' ' . $this->surname;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getGuidingHand(): ?string
    {
        return $this->guidingHand;
    }

    public function setGuidingHand(?string $guidingHand): self
    {
        $this->guidingHand = $guidingHand;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getWeight(): ?string
    {
        return $this->weight;
    }

    public function setWeight(string $weight): self
    {
        $this->weight = $weight;

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

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getDistinctive(): ?string
    {
        return $this->distinctive;
    }

    public function setDistinctive(?string $distinctive): self
    {
        $this->distinctive = $distinctive;

        return $this;
    }

    public function getOccupation(): ?string
    {
        return $this->occupation;
    }

    public function setOccupation(?string $occupation): self
    {
        $this->occupation = $occupation;

        return $this;
    }

    public function getStory(): ?string
    {
        return $this->story;
    }

    public function setStory(?string $story): self
    {
        $this->story = $story;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }

    public function getIsPremade(): ?bool
    {
        return $this->isPremade;
    }

    public function setIsPremade(bool $isPremade): self
    {
        $this->isPremade = $isPremade;

        return $this;
    }

    public function getBirthplace(): ?string
    {
        return $this->birthplace;
    }

    public function setBirthplace(?string $birthplace): self
    {
        $this->birthplace = $birthplace;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getHomeplace(): ?string
    {
        return $this->homeplace;
    }

    public function setHomeplace(?string $homeplace): self
    {
        $this->homeplace = $homeplace;

        return $this;
    }

    public function getRelatives(): ?string
    {
        return $this->relatives;
    }

    public function setRelatives(?string $relatives): self
    {
        $this->relatives = $relatives;

        return $this;
    }

    public function getAllegiance(): ?string
    {
        return $this->allegiance;
    }

    public function setAllegiance(?string $allegiance): self
    {
        $this->allegiance = $allegiance;

        return $this;
    }

    public function getCoinpurse(): ?int
    {
        return $this->coinpurse;
    }

    public function setCoinpurse(?int $coinpurse): self
    {
        $this->coinpurse = $coinpurse;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
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

    public function getTribe(): ?Tribe
    {
        return $this->tribe;
    }

    public function setTribe(?Tribe $tribe): self
    {
        $this->tribe = $tribe;

        return $this;
    }

    public function clearId()
    {
        $this->id = null;

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
            $characterSpell->setCharacters($this);
        }

        return $this;
    }

    public function removeCharacterSpell(CharacterSpell $characterSpell): self
    {
        if ($this->characterSpells->removeElement($characterSpell)) {
            // set the owning side to null (unless already changed)
            if ($characterSpell->getCharacters() === $this) {
                $characterSpell->setCharacters(null);
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
            $characterCharacteristic->setCharacter($this);
        }

        return $this;
    }

    public function removeCharacterCharacteristic(CharacterCharacteristic $characterCharacteristic): self
    {
        if ($this->characterCharacteristics->removeElement($characterCharacteristic)) {
            // set the owning side to null (unless already changed)
            if ($characterCharacteristic->getCharacter() === $this) {
                $characterCharacteristic->setCharacter(null);
            }
        }

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
            $characterSkill->setCharacter($this);
        }

        return $this;
    }

    public function removeCharacterSkill(CharacterSkill $characterSkill): self
    {
        if ($this->characterSkills->removeElement($characterSkill)) {
            // set the owning side to null (unless already changed)
            if ($characterSkill->getCharacter() === $this) {
                $characterSkill->setCharacter(null);
            }
        }

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
            $equipment->addCharacter($this);
        }

        return $this;
    }

    public function removeEquipment(Equipment $equipment): self
    {
        if ($this->equipments->removeElement($equipment)) {
            $equipment->removeCharacter($this);
        }

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
            $specialty->addCharacter($this);
        }

        return $this;
    }

    public function removeSpecialty(Specialty $specialty): self
    {
        if ($this->specialties->removeElement($specialty)) {
            $specialty->removeCharacter($this);
        }

        return $this;
    }

    /**
     * @return Collection|ScenarioCharacter[]
     */
    public function getScenarioCharacters(): Collection
    {
        return $this->scenarioCharacters;
    }

    public function addScenarioCharacter(ScenarioCharacter $scenarioCharacter): self
    {
        if (!$this->scenarioCharacters->contains($scenarioCharacter)) {
            $this->scenarioCharacters[] = $scenarioCharacter;
            $scenarioCharacter->setPersonnage($this);
        }

        return $this;
    }

    public function removeScenarioCharacter(ScenarioCharacter $scenarioCharacter): self
    {
        if ($this->scenarioCharacters->removeElement($scenarioCharacter)) {
            // set the owning side to null (unless already changed)
            if ($scenarioCharacter->getPersonnage() === $this) {
                $scenarioCharacter->setPersonnage(null);
            }
        }

        return $this;
    }

    public function getChaos(): ?int
    {
        return $this->chaos;
    }

    public function setChaos(?int $chaos): self
    {
        $this->chaos = $chaos;

        return $this;
    }

    public function getBalance(): ?int
    {
        return $this->balance;
    }

    public function setBalance(?int $balance): self
    {
        $this->balance = $balance;

        return $this;
    }

    public function getLoi(): ?int
    {
        return $this->loi;
    }

    public function setLoi(?int $loi): self
    {
        $this->loi = $loi;

        return $this;
    }
}
