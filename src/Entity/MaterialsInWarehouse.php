<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
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

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Regex(
     * pattern="/^[1-9]\d*$/",
     * message="Liczba musi być większa od 0"
     * )
     */
    private $Amount;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Regex("/^[0-9][0-9]?$|^100$/")
     */
    private $VAT;

    /**
     * @ORM\Column(type="float")
     * @Assert\Regex("/^\d{0,8}(\.\d{1,4})?$/")
     */
    private $UnitPrice;

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

    public function getAmount(): ?int
    {
        return $this->Amount;
    }

    public function setAmount(?int $Amount): self
    {
        $this->Amount = $Amount;

        return $this;
    }

    public function getVAT(): ?float
    {
        return $this->VAT;
    }

    public function setVAT(?float $VAT): self
    {
        $this->VAT = $VAT;

        return $this;
    }

    public function getUnitPrice(): ?float
    {
        return $this->UnitPrice;
    }

    public function setUnitPrice(float $UnitPrice): self
    {
        $this->UnitPrice = $UnitPrice;

        return $this;
    }
}
