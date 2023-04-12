<?php

namespace App\Entity\Shop;

use App\Repository\Shop\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Faker\Factory;
use Faker\Generator;

#[
    ORM\Entity(repositoryClass: ProductRepository::class),
    ORM\Table(name: "shop.product_entity")
]
class ProductEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $model;

    #[ORM\Column(length: 50)]
    private string $uniqCode;

    #[ORM\ManyToOne(cascade: ['persist'], inversedBy: 'productEntities')]
    #[ORM\JoinColumn(nullable: false)]
    private VendorEntity $vendorId;

    /**
     * @return self
     */
    public static function fromPublicFields(
        string       $model,
        string       $uniqCode,
        VendorEntity $vendorId
    ): self
    {
        $self = new self();
        $self->model = $model;
        $self->uniqCode = $uniqCode;
        $self->vendorId = $vendorId;

        return $self;
    }

    /**
     * @return self[]
     * @throws \Exception
     */
    public static function fromRandProducts(Generator $faker, VendorEntity $vendorId, int $count): array
    {
        $array = [];
        for ($i = 1; $i <= $count; $i++) {
            $array[] = self::fromPublicFields(
                $faker->company(),
                hash('crc32b', random_bytes(20)),
                $vendorId
            );
        }

        return $array;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getUniqCode(): string
    {
        return $this->uniqCode;
    }

    public function setUniqCode(string $uniqCode): self
    {
        $this->uniqCode = $uniqCode;

        return $this;
    }

    public function getVendorId(): VendorEntity
    {
        return $this->vendorId;
    }

    public function setVendorId(VendorEntity $vendorId): self
    {
        $this->vendorId = $vendorId;

        return $this;
    }
}
