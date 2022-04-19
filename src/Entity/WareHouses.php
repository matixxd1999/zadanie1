<?php

namespace App\Entity;

use App\Repository\WareHousesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WareHousesRepository::class)
 */
class WareHouses
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
    private $WareHouseName;

    /**
     * @ORM\OneToMany(targetEntity=MaterialsInWarehouse::class, mappedBy="WareHouse")
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

    public function getWareHouseName(): ?string
    {
        return $this->WareHouseName;
    }

    public function setWareHouseName(string $WareHouseName): self
    {
        $this->WareHouseName = $WareHouseName;

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
            $materialsInWarehouse->setWareHouse($this);
        }

        return $this;
    }

    public function removeMaterialsInWarehouse(MaterialsInWarehouse $materialsInWarehouse): self
    {
        if ($this->materialsInWarehouses->removeElement($materialsInWarehouse)) {
            // set the owning side to null (unless already changed)
            if ($materialsInWarehouse->getWareHouse() === $this) {
                $materialsInWarehouse->setWareHouse(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->WareHouseName;
    }
}
