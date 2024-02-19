<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TripRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[ORM\Entity(repositoryClass: TripRepository::class)]
class Trip
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["get_trips", "get_trip"])]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(["get_trips", "get_trip"])]
    #[Assert\NotBlank(message: "Le nom du voyage ne peut pas être vide.")]
    private ?string $name = null;

    #[ORM\Column]
    #[Groups(["get_trips", "get_trip"])]
    #[Assert\NotBlank(message: "La date de début ne peut pas être vide.")]
    #[Assert\Type(
        type: \DateTimeImmutable::class,
        message: 'La date de début {{ value }} n\'est pas valide car ce n\'est pas date de type {{ type }}.',
    )]  
    private ?\DateTimeImmutable $startDate = null;

    #[ORM\Column]
    #[Groups(["get_trips", "get_trip"])]
    #[Assert\NotBlank(message: "La date de fin ne peut pas être vide.")]
    #[Assert\Type(
        type: \DateTimeImmutable::class,
        message: 'La date de fin {{ value }} n\'est pas valide car ce n\'est pas date de type {{ type }}.',
    )]  
    private ?\DateTimeImmutable $endDate = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(["get_trip"])]
    #[Assert\NotBlank(message: "La description du voyage ne peut pas être vide.")]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT,  nullable: true)]
    private ?string $backgroundPicture = null;

    #[ORM\Column(length: 2083, nullable: true)]
    #[Groups(["get_trips", "get_trip"])]
    private ?string $backgroundPictureURL = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull(message: "L'administrateur du voyage ne peut pas être vide.")]
    #[Assert\Type(
        type: User::class,
        message: 'L\'utilisateur {{ value }} n\'est pas valide car ce n\'est pas date de type {{ type }}.',
    )]  
    private ?User $admin = null;

    #[ORM\Column]
    #[Assert\NotNull(message: "La date de création ne peut pas être vide.")]
    #[Assert\Type(
        type: \DateTimeImmutable::class,
        message: 'La date de création {{ value }} n\'est pas valide car ce n\'est pas date de type {{ type }}.',
    )]  
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Type(
        type: \DateTimeImmutable::class,
        message: 'La date de mise à jour {{ value }} n\'est pas valide car ce n\'est pas date de type {{ type }}.',
    )]  
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'trips')]
    #[Groups(["get_travelers"])]
    private Collection $travelers;

    #[ORM\ManyToMany(targetEntity: City::class)]
    private Collection $cities;

    #[ORM\OneToMany(mappedBy: 'trip', targetEntity: Activity::class)]
    private Collection $activities;

    #[ORM\OneToMany(mappedBy: 'trip', targetEntity: Item::class)]
    private Collection $items;

   

    public function __construct()
    {
        $this->travelers = new ArrayCollection();
        $this->cities = new ArrayCollection();
        $this->activities = new ArrayCollection();
        $this->items = new ArrayCollection();
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

    public function getStartDate(): ?\DateTimeImmutable
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeImmutable $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeImmutable
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeImmutable $endDate): static
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getBackgroundPicture(): ?string
    {
        return $this->backgroundPicture;
    }

    public function setBackgroundPicture(?string $backgroundPicture): static
    {
        $this->backgroundPicture = $backgroundPicture;

        return $this;
    }

    public function getAdmin(): ?User
    {
        return $this->admin;
    }

    public function setAdmin(?User $admin): static
    {
        $this->admin = $admin;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

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

    /**
     * @return Collection<int, User>
     */
    public function getTravelers(): Collection
    {
        return $this->travelers;
    }

    public function addTraveler(User $traveler): static
    {
        if (!$this->travelers->contains($traveler)) {
            $this->travelers->add($traveler);
        }

        return $this;
    }

    public function removeTraveler(User $traveler): static
    {
        $this->travelers->removeElement($traveler);

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
        }

        return $this;
    }

    public function removeCity(City $city): static
    {
        $this->cities->removeElement($city);

        return $this;
    }

    /**
     * @return Collection<int, Activity>
     */
    public function getActivities(): Collection
    {
        return $this->activities;
    }

    public function addActivity(Activity $activity): static
    {
        if (!$this->activities->contains($activity)) {
            $this->activities->add($activity);
            $activity->setTrip($this);
        }

        return $this;
    }

    public function removeActivity(Activity $activity): static
    {
        if ($this->activities->removeElement($activity)) {
            // set the owning side to null (unless already changed)
            if ($activity->getTrip() === $this) {
                $activity->setTrip(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Item>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Item $item): static
    {
        if (!$this->items->contains($item)) {
            $this->items->add($item);
            $item->setTrip($this);
        }

        return $this;
    }

    public function removeItem(Item $item): static
    {
        if ($this->items->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getTrip() === $this) {
                $item->setTrip(null);
            }
        }

        return $this;
    }

    public function getBackgroundPictureURL(): ?string
    {
        return $this->backgroundPictureURL;
    }

    public function setBackgroundPictureURL(?string $backgroundPictureURL): static
    {
        $this->backgroundPictureURL = $backgroundPictureURL;

        return $this;
    }

}
