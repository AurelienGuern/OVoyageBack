<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Entity\Activity;
use App\Entity\Vote;
use App\Repository\VoteRepository;
use App\Service\UserFinder;
use App\Service\UserVerification;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;


#[Route('/api/vote')]

class VoteController extends AbstractController
{
    private User $user;

    public function __construct(UserFinder $userFinder)
    {
        $this->user = $userFinder->findTheUser();
    }

    #[Route('/{id<\d+>}', name: 'api_vote_activity_user_add', methods: ['POST'])]
    public function add(
        Activity $activity = null,
        EntityManagerInterface $em,
        SerializerInterface $serializer,
        Request $request,
        ValidatorInterface $validator,
        VoteRepository $vr,
        UserVerification $userVerification
    ): JsonResponse {

        if (null === $activity) {
            return $this->json(["message" => "L'activité n'existe pas."], Response::HTTP_NOT_FOUND); // Si le voyageur ne fait pas partie du voyage, ce message est retourné.
        }

        $trip = $activity->getTrip();

        if (!$userVerification->trip($trip)) {
            return $this->json(["message" => "Cet utilisateur ne fait pas partie de ce voyage."], Response::HTTP_FORBIDDEN); // Si le voyageur ne fait pas partie du voyage, ce message est retourné.
        }

        foreach ($activity->getVotes() as $votesByUser)
        {
            if($votesByUser->getUser() === $this->user)
            {
                return $this->json(["message" => "Cet utilisateur a déjà voter pour cette activité."], Response::HTTP_FORBIDDEN); // Si le voyageur ne fait pas partie du voyage, ce message est retourné.
            }
        }

        $json = $request->getContent();

        $vote = $serializer->deserialize($json, Vote::class, 'json');
        $vote->setUser($this->user);
        $vote->setActivity($activity);

        $errors = $validator->validate($vote);

        if (count($errors)) {
            return $this->json($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $em->persist($vote);
        $em->flush();

        // $score = $vr->getAverageForActivity($activity)[0][1];

        // $activity->setScore($score);
        // $em->persist($activity);
        $em->flush();

        return $this->json(["message" => 'Le vote a été pris en compte ! Le score de l\'activité est de ' . $activity->getScore()], Response::HTTP_OK, [], ["groups" => ["votes"]]);

    }

    #[Route('/{id<\d+>}', name: 'api_vote_activity_user_delete', methods: ['DELETE'])]
    public function delete(
        Activity $activity = null,
        EntityManagerInterface $em,
        VoteRepository $vr,
        UserVerification $userVerification
    ): JsonResponse {

        if (null === $activity) {
            return $this->json(["message" => "L'activité n'existe pas."], Response::HTTP_NOT_FOUND); // Si le voyageur ne fait pas partie du voyage, ce message est retourné.
        }

        $trip = $activity->getTrip();

        if (!$userVerification->trip($trip)) {
            return $this->json(["message" => "Cet utilisateur ne fait pas partie de ce voyage"], Response::HTTP_FORBIDDEN); // Si le voyageur ne fait pas partie du voyage, ce message est retourné.
        }

        foreach($activity->getVotes() as $actualVote)
        {
            if($actualVote->getUser() === $this->user)
            {
                $em->remove($actualVote);
                $em->flush();

                // $score = $vr->getAverageForActivity($activity)[0][1];

                // $activity->setScore($score);
                // $em->persist($activity);
                $em->flush();

                return $this->json(["message" => 'Votre vote a bien été supprimé ! Le score de l\'acitivité est de ' . ($activity->getScore() ? $activity->getScore() : "0")], Response::HTTP_OK);

            }
        }
        return $this->json(["message" => 'L\'activité n\'existe pas.'], Response::HTTP_NOT_FOUND);
    }

    #[Route('/{id<\d+>}', name: 'api_vote_activity_user_read', methods: ['GET'])]
    public function read(
        Activity $activity = null,
        UserVerification $userVerification,
    ): JsonResponse {

        if (null === $activity) {
            return $this->json(["message" => "L'activité n'existe pas."], Response::HTTP_NOT_FOUND); // Si le voyageur ne fait pas partie du voyage, ce message est retourné.
        }

        $trip = $activity->getTrip();

        if (!$userVerification->trip($trip)) {
            return $this->json(["message" => "Cet utilisateur ne fait pas partie de ce voyage"], Response::HTTP_FORBIDDEN); // Si le voyageur ne fait pas partie du voyage, ce message est retourné.
        }

        foreach($this->user->getVotes() as $actualVote)
        {
            if($actualVote->getActivity() === $activity)
            {
                return $this->json(["rating" => ($actualVote->getRating() ? $actualVote->getRating() : "Vous n'avez pas encore voté pour cette activité")], Response::HTTP_OK, [], ["groups" => "get_vote"]);
            }
        }

        return $this->json(["message" => 'L\'activité n\'existe pas.'], Response::HTTP_NOT_FOUND);
    }
}
