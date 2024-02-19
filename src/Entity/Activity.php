<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ActivityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ActivityRepository::class)]
class Activity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["get_activities", "get_activity", "filter"])]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(["get_activities", "get_activity", "filter"])]
    #[Assert\NotBlank(message: "Le nom de l'activité ne peut pas être vide.")]
    #[Assert\Length(
        max: 50,
        maxMessage: "Le nom de l'activité ne peut pas dépasser {{ limit }} caractères."
    )]
    #[Assert\Type(
        type: 'string',
        message: 'Le nom {{ value }} n\'est pas valide car ce n\'est pas une {{ type }}.',
    )]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    #[Groups(["get_activities", "get_activity", "filter"])]
    #[Assert\Type(
        type: \DateTimeImmutable::class,
        message: 'La date {{ value }} n\'est pas valide car ce n\'est pas date de type {{ type }}.',
    )]
    private ?\DateTimeImmutable $date = null;

    #[ORM\Column(length: 255, nullable: false)]
    #[Assert\Length(
        max: 255,
        maxMessage: "L'adresse postale de l'activité ne peut pas dépasser {{ limit }} caractères."
    )]
    #[Groups(["get_activity"])]
    #[Assert\Type(
        type: "string",
        message: 'L\'adresse {{ value }} n\'est pas valide car ce n\'est pas de type {{ type }}.',
    )]
    private ?string $postalAddress = null;

    #[ORM\Column(nullable: true)]
    #[Groups(["get_activity"])]
    #[Assert\PositiveOrZero(message: "Le prix de l'activité doit être un nombre positif ou zéro.")]
    #[Assert\Type(
        type: "int",
        message: 'Le prix {{ value }} n\'est pas valide car il n\'est pas de type {{ type }}.',
    )]
    private ?int $price = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(["get_activity"])]
    #[Assert\Type(
        type: "string",
        message: 'Les jours et heures d\'ouvertures {{ value }} ne sont pas valide car elles ne sont pas de type {{ type }}.',
    )]
    private ?string $openingTimeAndDays = null;

    #[ORM\Column(nullable: true)]
    #[Groups(["get_activities", "get_activity", "filter"])]
    #[Assert\Range(
        min: 0,
        notInRangeMessage: "La note de l'activité doit être comprise entre {{ min }} et {{ max }}."
    )]
    #[Assert\Type(
        type: "integer",
        message: 'Le score {{ value }} n\'est pas valide car il n\'est pas du type {{ type }}.',
    )]
    private ?int $score = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["get_activities", "get_activity", "filter"])]
    #[Assert\Type(
        type: City::class,
        message: 'La ville {{ value }} n\'est pas valide car elle n\'est pas du type {{ type }}.',
    )]
    #[Assert\NotBlank(message: "Une activité doit être relié à une ville")]
    private ?City $city = null;

    #[ORM\ManyToOne(inversedBy: 'activities')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\Type(
        type: Trip::class,
        message: 'Le voyage {{ value }} n\'est pas valide car il n\'est pas du type {{ type }}.',
    )]
    #[Assert\NotBlank(message: "Une activité doit être relié à un voyage.")]
    private ?Trip $trip = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\Type(
        type: User::class,
        message: 'L\'utilisateur {{ value }} n\'est pas valide car il n\'est pas du type {{ type }}.',
    )]
    #[Assert\NotBlank(message: "Une activité doit être relié à un créateur (utilisateur).")]
    #[Groups(["get_activities", "get_activity"])]
    private ?User $creator = null;

    #[ORM\ManyToMany(targetEntity: Tag::class)]
    #[Groups(["get_activities", 'get_activity', "trip_detail"])]
    private Collection $tags;

    #[ORM\OneToMany(mappedBy: 'activity', targetEntity: Vote::class)]
    private Collection $votes;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->votes = new ArrayCollection();
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

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getPostalAddress(): ?string
    {
        return $this->postalAddress;
    }

    public function setPostalAddress(?string $postalAddress): static
    {
        $this->postalAddress = $postalAddress;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getOpeningTimeAndDays(): ?string
    {
        return $this->openingTimeAndDays;
    }

    public function setOpeningTimeAndDays(?string $openingTimeAndDays): static
    {
        $this->openingTimeAndDays = $openingTimeAndDays;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(?int $score): static
    {
        $this->score = $score;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getTrip(): ?Trip
    {
        return $this->trip;
    }

    public function setTrip(?Trip $trip): static
    {
        $this->trip = $trip;

        return $this;
    }

    public function getCreator(): ?User
    {
        return $this->creator;
    }

    public function setCreator(?User $creator): static
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): static
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    /**
     * @return Collection<int, Vote>
     */
    public function getVotes(): Collection
    {
        return $this->votes;
    }

    public function addVote(Vote $vote): static
    {
        if (!$this->votes->contains($vote)) {
            $this->votes->add($vote);
            $vote->setActivity($this);
        }

        return $this;
    }

    public function removeVote(Vote $vote): static
    {
        if ($this->votes->removeElement($vote)) {
            // set the owning side to null (unless already changed)
            if ($vote->getActivity() === $this) {
                $vote->setActivity(null);
            }
        }

        return $this;
    }
}
