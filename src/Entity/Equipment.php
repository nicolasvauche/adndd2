<?php

namespace App\Entity;

use App\Repository\EquipmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EquipmentRepository::class)
 */
class Equipment
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
     * @ORM\Column(type="integer")
     */
    private $base;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $damage;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $hands;

    /**
     * @ORM\Column(type="integer")
     */
    private $health;

    /**
     * @ORM\Column(type="integer")
     */
    private $ranged;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $armorPoints;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $skillModifyer;

    /**
     * @ORM\ManyToOne(targetEntity=EquipmentType::class, inversedBy="equipments")
     */
    private $equipmentType;

    /**
     * @ORM\ManyToMany(targetEntity=Game::class, mappedBy="equipments")
     */
    private $games;

    /**
     * @ORM\ManyToMany(targetEntity=Character::class, inversedBy="equipments")
     */
    private $characters;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $structure;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $size;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $impale;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $ward;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fordex;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dexdex;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numberRound;

    public function __construct()
    {
        $this->games = new ArrayCollection();
        $this->characters = new ArrayCollection();
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

    public function getBase(): ?int
    {
        return $this->base;
    }

    public function setBase(int $base): self
    {
        $this->base = $base;

        return $this;
    }

    public function getDamage(): ?string
    {
        return $this->damage;
    }

    public function setDamage(string $damage): self
    {
        $this->damage = $damage;

        return $this;
    }

    public function getHands(): ?int
    {
        return $this->hands;
    }

    public function setHands(?int $hands): self
    {
        $this->hands = $hands;

        return $this;
    }

    public function getHealth(): ?int
    {
        return $this->health;
    }

    public function setHealth(int $health): self
    {
        $this->health = $health;

        return $this;
    }

    public function getRanged(): ?int
    {
        return $this->ranged;
    }

    public function setRanged(int $ranged): self
    {
        $this->ranged = $ranged;

        return $this;
    }

    public function getArmorPoints(): ?int
    {
        return $this->armorPoints;
    }

    public function setArmorPoints(?int $armorPoints): self
    {
        $this->armorPoints = $armorPoints;

        return $this;
    }

    public function getSkillModifyer(): ?int
    {
        return $this->skillModifyer;
    }

    public function setSkillModifyer(?int $skillModifyer): self
    {
        $this->skillModifyer = $skillModifyer;

        return $this;
    }

    public function getEquipmentType(): ?EquipmentType
    {
        return $this->equipmentType;
    }

    public function setEquipmentType(?EquipmentType $equipmentType): self
    {
        $this->equipmentType = $equipmentType;

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
            $game->addEquipment($this);
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        if ($this->games->removeElement($game)) {
            $game->removeEquipment($this);
        }

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
        }

        return $this;
    }

    public function removeCharacter(Character $character): self
    {
        $this->characters->removeElement($character);

        return $this;
    }

    public function getStructure(): ?string
    {
        return $this->structure;
    }

    public function setStructure(?string $structure): self
    {
        $this->structure = $structure;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(?string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getImpale(): ?bool
    {
        return $this->impale;
    }

    public function setImpale(?bool $impale): self
    {
        $this->impale = $impale;

        return $this;
    }

    public function getWard(): ?bool
    {
        return $this->ward;
    }

    public function setWard(?bool $ward): self
    {
        $this->ward = $ward;

        return $this;
    }

    public function getFordex(): ?string
    {
        return $this->fordex;
    }

    public function setFordex(?string $fordex): self
    {
        $this->fordex = $fordex;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDexdex(): ?string
    {
        return $this->dexdex;
    }

    public function setDexdex(?string $dexdex): self
    {
        $this->dexdex = $dexdex;

        return $this;
    }

    public function getNumberRound(): ?string
    {
        return $this->numberRound;
    }

    public function setNumberRound(?string $numberRound): self
    {
        $this->numberRound = $numberRound;

        return $this;
    }
}
