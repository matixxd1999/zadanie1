<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\JoinColumn(nullable=false)
     */
    private $UnitShortName;

    /**
     * @ORM\ManyToMany(targetEntity=MaterialsInWarehouse::class, mappedBy="ArticleID")
     */
    private $materialsInWarehouses;

    public function __construct()
    {
        $this->materialsInWarehouses = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, MaterialsInWarehouse>
     */
    public function getMaterialsInWarehouses(): Collection
    {
        return $this->materialsInWarehouses;
    }

    public function addMaterialsInWarehouse(MaterialsInWarehouse $materialsInWarehouse): self
    {
        if (!$this->materialsInWarehouses->contains($materialsInWarehouse)) {
            $this->materialsInWarehouses[] = $materialsInWarehouse;
            $materialsInWarehouse->addArticleID($this);
        }

        return $this;
    }

    public function removeMaterialsInWarehouse(MaterialsInWarehouse $materialsInWarehouse): self
    {
        if ($this->materialsInWarehouses->removeElement($materialsInWarehouse)) {
            $materialsInWarehouse->removeArticleID($this);
        }

        return $this;
    }
    public function __toString()
    {
        return $this->ArticleName;    
    }
}
