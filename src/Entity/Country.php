<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CountryRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
class Country
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["get_countries", "get_cities", "get_city"])]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(["get_countries", "get_city"])]
    #[Assert\NotBlank(message: "Le nom du pays ne peut pas être vide.")]
    #[Assert\Length(
        max: 50,
        maxMessage: "Le nom du pays ne peut pas dépasser {{ limit }} caractères."
    )]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $countryPicture = null;

    #[ORM\OneToMany(mappedBy: 'country', targetEntity: City::class)]
    #[Groups(["get_cities"])]
    private Collection $cities;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 2083, nullable: true)]
    #[Groups(["get_countries", "get_cities", "get_city"])]
    private ?string $countryPictureURL = null;

    public function __construct()
    {
        $this->cities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, City>
     */
    public function getCities(): Collection
    {
        return $this->cities;
    }

    public function addCity(City $city): static
    {
        if (!$this->cities->contains($city)) {
            $this->cities->add($city);
            $city->setCountry($this);
        }

        return $this;
    }

    public function removeCity(City $city): static
    {
        if ($this->cities->removeElement($city)) {
            // set the owning side to null (unless already changed)
            if ($city->getCountry() === $this) {
                $city->setCountry(null);
            }
        }

        return $this;
    }

    /**
     * Get the value of countryPictureFile
     */ 
    public function getCountryPicture(): ?string
    {
        return $this->countryPicture;
    }

    /**
     * Set the value of countryPictureFile
     *
     * @return  self
     */ 
    public function setCountryPicture(?string $countryPictureFile): static
    {
        $this->countryPicture = $countryPictureFile;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCountryPictureURL(): ?string
    {
        return $this->countryPictureURL;
    }

    public function setCountryPictureURL(?string $countryPictureURL): static
    {
        $this->countryPictureURL = $countryPictureURL;

        return $this;
    }
}
