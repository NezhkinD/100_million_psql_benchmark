<?php

namespace App\Entity\Shop;

use App\Repository\Shop\VendorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[
    ORM\Entity(repositoryClass: VendorRepository::class),
    ORM\Table(name: "shop.vendor_entity")
]
class VendorEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\OneToMany(mappedBy: 'vendorId', targetEntity: ProductEntity::class, cascade: ['persist'])]
    private Collection $productEntities;

    public function __construct()
    {
        $this->productEntities = new ArrayCollection();
    }

    /**
     * @return self
     */
    public static function fromFields(string $name): self
    {
        $self = new self();
        $self->name = $name;
        return $self;
    }


    /**
     * @return self[]
     */
    public static function fromPhoneVendors(): array
    {
        return [
            self::fromFields('apple'),
            self::fromFields('asus'),
            self::fromFields('doogee'),
            self::fromFields('haier'),
            self::fromFields('honor'),
            self::fromFields('huawei'),
            self::fromFields('oppo'),
            self::fromFields('oneplus'),
            self::fromFields('oukitel'),
            self::fromFields('poco'),
            self::fromFields('samsung'),
            self::fromFields('sony'),
            self::fromFields('vivo'),
            self::fromFields('xiaomi'),
            self::fromFields('zte'),
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Collection<int, ProductEntity>
     */
    public function getProductEntities(): Collection
    {
        return $this->productEntities;
    }

    public function addProductEntity(ProductEntity $productEntity): self
    {
        if (!$this->productEntities->contains($productEntity)) {
            $this->productEntities->add($productEntity);
            $productEntity->setVendorId($this);
        }

        return $this;
    }

    public function removeProductEntity(ProductEntity $productEntity): self
    {
        if ($this->productEntities->removeElement($productEntity)) {
            // set the owning side to null (unless already changed)
            if ($productEntity->getVendorId() === $this) {
                $productEntity->setVendorId(null);
            }
        }

        return $this;
    }
}
