<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\FriendRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FriendRepository::class)]
class Friend
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["get_friends"])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'friends', cascade:["persist"])]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank(message: "L'utilisateur 1 ne peut pas être vide.")]
    #[Assert\Type(
        type: User::class,
        message: 'L\'utilisateur {{ value }} n\'est pas valide car ce n\'est pas date de type {{ type }}.',
    )]  
    private ?User $user1 = null;

    #[ORM\ManyToOne(cascade:["persist"])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["get_friends"])]
    #[Assert\NotBlank(message: "L'utilisateur 2 ne peut pas être vide.")]
    #[Assert\Type(
        type: User::class,
        message: 'L\'utilisateur {{ value }} n\'est pas valide car ce n\'est pas date de type {{ type }}.',
    )]  
    private ?User $user2 = null;

    #[ORM\Column]
    private ?bool $relationship = null;

    #[ORM\Column]
    private ?bool $createdBy = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser1(): ?User
    {
        return $this->user1;
    }

    public function setUser1(?User $user1): static
    {
        $this->user1 = $user1;

        return $this;
    }

    public function getUser2(): ?User
    {
        return $this->user2;
    }

    public function setUser2(?User $user2): static
    {
        $this->user2 = $user2;

        return $this;
    }

    public function isRelationship(): ?bool
    {
        return $this->relationship;
    }

    public function setRelationship(bool $relationship): static
    {
        $this->relationship = $relationship;

        return $this;
    }

    public function isCreatedBy(): ?bool
    {
        return $this->createdBy;
    }

    public function setCreatedBy(bool $createdBy): static
    {
        $this->createdBy = $createdBy;

        return $this;
    }
}
