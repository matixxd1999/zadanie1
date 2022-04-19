<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticlesRepository::class)
 */
class Articles
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
    private $ArticleName;

    /**
     * @ORM\ManyToOne(targetEntity=Units::class, inversedBy="articles")
     */
    private $UnitShortName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticleName(): ?string
    {
        return $this->ArticleName;
    }

    public function setArticleName(string $ArticleName): self
    {
        $this->ArticleName = $ArticleName;

        return $this;
    }

    public function getUnitShortName(): ?Units
    {
        return $this->UnitShortName;
    }

    public function setUnitShortName(?Units $UnitShortName): self
    {
        $this->UnitShortName = $UnitShortName;

        return $this;
    }

    public function __toString()
    {
        return $this->ArticleName;
    }
}
