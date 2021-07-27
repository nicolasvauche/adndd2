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

    public function __construct()
    {
        $this->gameRules = new ArrayCollection();
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
}
