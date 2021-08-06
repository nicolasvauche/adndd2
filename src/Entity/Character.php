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

    public function __construct()
    {
        $this->characterSpells = new ArrayCollection();
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
}
