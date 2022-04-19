<?php

namespace App\Entity;

use App\Repository\MaterialsInWarehouseRepository;
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
     * @ORM\ManyToOne(targetEntity=WareHouses::class, inversedBy="materialsInWarehouses")
     */
    private $WareHouse;

    /**
     * @ORM\OneToOne(targetEntity=Articles::class, cascade={"persist", "remove"})
     */
    private $Article;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWareHouse(): ?WareHouses
    {
        return $this->WareHouse;
    }

    public function setWareHouse(?WareHouses $WareHouse): self
    {
        $this->WareHouse = $WareHouse;

        return $this;
    }

    public function getArticle(): ?Articles
    {
        return $this->Article;
    }

    public function setArticle(?Articles $Article): self
    {
        $this->Article = $Article;

        return $this;
    }
}
