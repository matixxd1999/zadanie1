<?php

namespace App\Entity;

use App\Repository\MaterialsInWarehouseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MaterialsInWarehouseRepository::class)
 */
class MaterialsInWarehouse
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=WareHouses::class, inversedBy="materialsInWarehouses")
     */
    private $WareHouseID;

    /**
     * @ORM\ManyToMany(targetEntity=Articles::class, inversedBy="materialsInWarehouses")
     */
    private $ArticleID;

    public function __construct()
    {
        $this->WareHouseID = new ArrayCollection();
        $this->ArticleID = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, WareHouses>
     */
    public function getWareHouseID(): Collection
    {
        return $this->WareHouseID;
    }

    public function addWareHouseID(WareHouses $wareHouseID): self
    {
        if (!$this->WareHouseID->contains($wareHouseID)) {
            $this->WareHouseID[] = $wareHouseID;
        }

        return $this;
    }

    public function removeWareHouseID(WareHouses $wareHouseID): self
    {
        $this->WareHouseID->removeElement($wareHouseID);

        return $this;
    }

    /**
     * @return Collection<int, Articles>
     */
    public function getArticleID(): Collection
    {
        return $this->ArticleID;
    }

    public function addArticleID(Articles $articleID): self
    {
        if (!$this->ArticleID->contains($articleID)) {
            $this->ArticleID[] = $articleID;
        }

        return $this;
    }

    public function removeArticleID(Articles $articleID): self
    {
        $this->ArticleID->removeElement($articleID);

        return $this;
    }
}
