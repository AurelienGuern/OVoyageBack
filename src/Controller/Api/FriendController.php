<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Entity\Friend;
use App\Service\UserFinder;
use App\Repository\FriendRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/friend')]
class FriendController extends AbstractController
{
    private User $user;

    public function __construct(UserFinder $userFinder)
    {
        $this->user = $userFinder->findTheUser();
    }

    #[Route('/', name: 'api_friend_read', methods: ["GET"])]
    public function read(): JsonResponse
    {
        return $this->json($this->user->getFriends(), Response::HTTP_OK, [], ["groups" => "get_friends"]);
    }

    #[Route('/add', name: 'api_friend_add', methods: ["POST"])]
    public function add(
        Request $request,
        UserRepository $userRepository,
        ValidatorInterface $validator,
        EntityManagerInterface $em,
    ): JsonResponse {

        $jsonContent = $request->getContent();
        $selectedUser = json_decode($jsonContent, true);

        $selectedUser = $userRepository->find($selectedUser["id"]);

        if ($this->user === $selectedUser) {
            return $this->json(["message" => "Vous ne pouvez pas vous ajouter en ami."], Response::HTTP_NOT_ACCEPTABLE);
        }

        foreach ($this->user->getFriends() as $friend) {
            if ($friend === $selectedUser) {
                return $this->json(["message" => "Vous êtes déjà amis !"], Response::HTTP_NOT_ACCEPTABLE);
            }
        }

        $newFriend = new Friend;
        $newFriend->setUser1($this->user);
        $newFriend->setUser2($selectedUser);
        $newFriend->setRelationship(false);
        $newFriend->setCreatedBy(true);

        $errors = $validator->validate($newFriend);

        if (count($errors)) {
            return $this->json(["message" => "Erreur lors de l'ajout", "errors" => $errors], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $em->persist($newFriend);

        $newFriend2 = new Friend;
        $newFriend2->setUser1($selectedUser);
        $newFriend2->setUser2($this->user);
        $newFriend2->setRelationship(false);
        $newFriend2->setCreatedBy(false);

        $errors = $validator->validate($newFriend2);

        if (count($errors)) {
            return $this->json(["message" => "Erreur lors de l'ajout", "errors" => $errors], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $em->persist($newFriend2);

        $em->flush();

        return $this->json(["message" => "Vous avez bien envoyé une demande d'ami à  {$selectedUser->getFirstname()} {$selectedUser->getLastname()}."], Response::HTTP_OK);
    }

    #[Route('/{id<\d+>}', name: 'api_friend_edit', methods: ["PUT"])]
    public function edit(
        EntityManagerInterface $em,
        Friend $friend,
        FriendRepository $friendRepository
    ): JsonResponse {

        foreach($this->user->getFriends() as $actualFriend)
        {
            if($actualFriend === $friend)
            {
                if ($friend->isCreatedBy()) 
                {
                    return $this->json(["message" => "Vous ne pouvez pas modifier la relation car vous êtes à l'origine de la demande d'amitié."], Response::HTTP_FORBIDDEN);
                }

                if ($friend->isRelationship())
                {
                    return $this->json(["message" => "Vous êtes déjà ami avec cette personne."], Response::HTTP_FORBIDDEN);
                }
        
                $friend->setRelationship(true);
        
                $em->persist($friend);
        
                $oppositeRelation = $friendRepository->findBy(["user1" => $friend->getUser2(), "user2" => $friend->getUser1()]);
                $oppositeRelation[0]->setRelationship(true);
        
                $em->persist($oppositeRelation[0]);
        
                $em->flush();
        
                return $this->json(["message" => "Vous avez accepté en ami {$oppositeRelation[0]->getUser1()->getFirstname()} {$oppositeRelation[0]->getUser1()->getLastname()}."], Response::HTTP_OK);
            }
        }

        return $this->json(["message" => "Vous ne pouvez pas modifier cette relation car vous n'êtes pas ami avec cette personne."], Response::HTTP_FORBIDDEN);
        
    }

    #[Route('/{id<\d+>}', name: 'api_friend_delete', methods: ["DELETE"])]
    public function delete(
        Friend $friend,
        EntityManagerInterface $em,
        FriendRepository $friendRepository
    ): JsonResponse 
    {
        foreach($this->user->getFriends() as $actualFriend)
        {
            if($actualFriend === $friend)
                {
                    $em->remove($friend);
                    $em->remove($actualFriend);

                    $oppositeRelation = $friendRepository->findBy(["user1" => $friend->getUser2(), "user2" => $friend->getUser1()]);
                    $em->remove($oppositeRelation[0]);

                    $em->flush();
            
                    return $this->json(["message" => "Relation d'amitié supprimé."], Response::HTTP_OK);
                }
            }

        return $this->json(["message" => "Vous ne pouvez pas modifier cette relation car vous n'êtes pas ami avec cette personne."], Response::HTTP_FORBIDDEN);
        
    }
}
