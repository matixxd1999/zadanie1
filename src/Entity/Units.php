<?php

namespace App\Entity;

use App\Repository\UnitsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UnitsRepository::class)
 */
class Units
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
    private $UnitShortName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $UnitLongName;

    /**
     * @ORM\OneToMany(targetEntity=Articles::class, mappedBy="UnitShortName")
     */
    private $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUnitShortName(): ?string
    {
        return $this->UnitShortName;
    }

    public function setUnitShortName(string $UnitShortName): self
    {
        $this->UnitShortName = $UnitShortName;

        return $this;
    }

    public function getUnitLongName(): ?string
    {
        return $this->UnitLongName;
    }

    public function setUnitLongName(string $UnitLongName): self
    {
        $this->UnitLongName = $UnitLongName;

        return $this;
    }

    /**
     * @return Collection<int, Articles>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Articles $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setUnitShortName($this);
        }

        return $this;
    }

    public function removeArticle(Articles $article): self
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getUnitShortName() === $this) {
                $article->setUnitShortName(null);
            }
        }

        return $this;
    }
}
