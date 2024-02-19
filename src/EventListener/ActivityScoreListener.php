<?php

namespace App\EventListener;

use App\Entity\Vote;
use App\Repository\VoteRepository;
use Doctrine\ORM\Events;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\PreFlushEventArgs;

#[AsEntityListener(event: Events::preFlush, method: 'preFlush', entity: Vote::class)]
class ActivityScoreListener
{
    // the entity listener methods receive two arguments:
    // the entity instance and the lifecycle event

    public function __construct(
        private VoteRepository $voteRepository,
        private EntityManagerInterface $em) 
    {}

    // #[AsEntityListener(event: Events::postPersist, method: 'postPersist', entity: Vote::class)]
    // public function postPersist(Vote $vote, PostPersistEventArgs $event): void
    // {
    //     $activity = $vote->getActivity();

    //     $activity->setScore($this->voteRepository->getAverageForActivity($activity)[0][1]);

    //     $this->em->flush();
    // }

    public function preFlush(Vote $vote, PreFlushEventArgs $event): void
    {
        $activity = $vote->getActivity();

        $activity->setScore($this->voteRepository->getTotalForActivity($activity)[0][1]);
    }
}