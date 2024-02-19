<?php

namespace App\Entity;

use App\Entity\Country;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CityRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;



#[ORM\Entity(repositoryClass: CityRepository::class)]
class City
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["get_cities", "get_city", "get_activities", "get_activity"])]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(["get_cities", "get_city", "get_activity", "get_activities", "filter"])]
    #[Assert\NotBlank(message: "Le nom de la ville ne peut pas être vide.")]
    #[Assert\Length(
        max: 50,
        maxMessage: "Le nom de la ville ne peut pas dépasser {{ limit }} caractères."
    )]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'cities')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups([ "get_city"])]
    #[Assert\NotBlank(message: "La ville doit être associée à un pays.")]
    #[Assert\Type(
        type: Country::class,
        message: 'Le pays {{ value }} n\'est pas valide car il n\'est pas du type {{ type }}.',
    )]
    private ?Country $country = null;

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

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): static
    {
        $this->country = $country;

        return $this;
    }
}
