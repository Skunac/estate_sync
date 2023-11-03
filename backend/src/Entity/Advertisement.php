<?php

namespace App\Entity;

use App\Repository\AdvertisementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdvertisementRepository::class)]
class Advertisement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(nullable: true)]
    private ?int $number_of_rooms = null;

    #[ORM\Column(nullable: true)]
    private ?int $number_of_bathrooms = null;

    #[ORM\Column]
    private ?int $area = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private ?\DateTimeInterface $publication_date = null;

    #[ORM\ManyToOne]
    private ?Good $good = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getNumberOfRooms(): ?int
    {
        return $this->number_of_rooms;
    }

    public function setNumberOfRooms(?int $number_of_rooms): static
    {
        $this->number_of_rooms = $number_of_rooms;

        return $this;
    }

    public function getNumberOfBathrooms(): ?int
    {
        return $this->number_of_bathrooms;
    }

    public function setNumberOfBathrooms(?int $number_of_bathrooms): static
    {
        $this->number_of_bathrooms = $number_of_bathrooms;

        return $this;
    }

    public function getArea(): ?int
    {
        return $this->area;
    }

    public function setArea(int $area): static
    {
        $this->area = $area;

        return $this;
    }

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publication_date;
    }

    public function setPublicationDate(\DateTimeInterface $publication_date): static
    {
        $this->publication_date = $publication_date;

        return $this;
    }

    public function getGood(): ?Good
    {
        return $this->good;
    }

    public function setGood(?Good $good): static
    {
        $this->good = $good;

        return $this;
    }
}
