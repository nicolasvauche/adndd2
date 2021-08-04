<?php

namespace App\Entity;

use App\Repository\GameSystemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameSystemRepository::class)
 */
class GameSystem
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
     * @ORM\OneToMany(targetEntity=Game::class, mappedBy="gameSystem")
     */
    private $games;

    /**
     * @ORM\ManyToOne(targetEntity=Diceset::class, inversedBy="gameSystem")
     */
    private $diceset;

    public function __construct()
    {
        $this->games = new ArrayCollection();
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
            $game->setGameSystem($this);
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        if ($this->games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getGameSystem() === $this) {
                $game->setGameSystem(null);
            }
        }

        return $this;
    }

    public function getDiceset(): ?Diceset
    {
        return $this->diceset;
    }

    public function setDiceset(?Diceset $diceset): self
    {
        $this->diceset = $diceset;

        return $this;
    }
}
