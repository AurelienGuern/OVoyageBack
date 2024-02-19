<?php

namespace App\Entity;

use App\Repository\VoteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: VoteRepository::class)]
class Vote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotNull(message: "La note ne peut pas être vide.")]
    #[Assert\Range(
        min: 1,
        max: 3,
        notInRangeMessage: "La note doit être comprise entre {{ min }} et {{ max }}."
    )]
    private ?int $rating = null;

    #[ORM\ManyToOne(inversedBy: 'votes')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["trip_detail", "get_users", "get_vote", "get_user"])]
    #[Assert\NotBlank(message: "L'utilisateur ne peut pas être vide.")]
    #[Assert\Type(
        type: User::class,
        message: 'L\'utilisateur {{ value }} n\'est pas valide car ce n\'est pas date de type {{ type }}.',
    )]  
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'votes')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank(message: "L'activité ne peut pas être vide.")]
    #[Assert\Type(
        type: Activity::class,
        message: 'L\'activité {{ value }} n\'est pas valide car ce n\'est pas date de type {{ type }}.',
    )]  
    private ?Activity $activity = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getActivity(): ?Activity
    {
        return $this->activity;
    }

    public function setActivity(?Activity $activity): static
    {
        $this->activity = $activity;

        return $this;
    }
}
