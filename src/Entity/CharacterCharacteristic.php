<?php

namespace App\Entity;

use App\Repository\CharacterCharacteristicRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CharacterCharacteristicRepository::class)
 */
class CharacterCharacteristic
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Character::class, inversedBy="characterCharacteristics")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $character;

    /**
     * @ORM\ManyToOne(targetEntity=Characteristic::class, inversedBy="characterCharacteristics")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $characteristic;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $base;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $modifyer;

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

    public function getCharacteristic(): ?Characteristic
    {
        return $this->characteristic;
    }

    public function setCharacteristic(?Characteristic $characteristic): self
    {
        $this->characteristic = $characteristic;

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

    public function getModifyer(): ?int
    {
        return $this->modifyer;
    }

    public function setModifyer(?int $modifyer): self
    {
        $this->modifyer = $modifyer;

        return $this;
    }
}
