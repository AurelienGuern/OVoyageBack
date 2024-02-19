<?php

namespace App\Controller\Api;

use App\Entity\Item;
use App\Entity\Trip;
use App\Entity\User;
use App\Service\UserFinder;
use App\Repository\ItemRepository;
use App\Repository\TripRepository;
use App\Service\UserVerification;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;


#[Route('/api')]
class ItemController extends AbstractController
{
    #[Route('/trip/{id<\d+>}/items', name: 'api_item_browse_suitcase_by_trip', methods: ["GET"])]
    public function browseBySuitcase(
        Trip $trip,
        ItemRepository $itemRepository
    ): JsonResponse {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        $items = $itemRepository->findByTripAndUser($trip, $user);

        if(count($items) <= 0)
        {
            return $this->json(["message" => "La valise est vide ! Ajoutez des items à votre valise pour commencer à la remplir pour votre voyage."], Response::HTTP_OK);
        }

        return $this->json($items, Response::HTTP_OK, [], ['groups' => 'get_items']);
    }

    #[Route('/trip/{id<\d+>}/item/add', name: 'api_item_add_item', methods: ["POST"])]
    public function add(
        Trip $trip,
        EntityManagerInterface $em,
        Request $request,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        UserVerification $userVerification
    ): JsonResponse {

        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        if (null === $trip) {
            return $this->json(["message" => "Le voyage demandé n'existe pas."], Response::HTTP_NOT_FOUND);
        }

        if (!$userVerification->trip($trip)) {
            return $this->json(["message" => "Le voyage demandée n'existe pas."], Response::HTTP_NOT_FOUND); // Si le voyageur ne fait pas partie du voyage, ce message est retourné.
        }

        $jsonContent = $request->getContent();
        $item = $serializer->deserialize($jsonContent, Item::class, "json");
        $item->setChecked(false);
        $item->setUser($user);
        $item->setTrip($trip);

        $errors = $validator->validate($item);

        if (count($errors)) {
            return $this->json(["message" => "Erreur lors de l'ajout de l'item", "errors" => $errors], Response::HTTP_UNPROCESSABLE_ENTITY); // TODO: A modifier
        }

        $em->persist($item);
        $em->flush();

        return $this->json(["message" => "Ajout de l'item OK"], Response::HTTP_OK);

    }

    #[Route('/item/{id<\d+>}', name: 'api_item_edit_item', methods: ["PUT"])]
    public function edit(
        Item $item,
        Request $request,
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        UserVerification $userVerification
    ): JsonResponse {

        if(!$userVerification->trip($item->getTrip())) {
            return $this->json(["message" => "Le voyage demandée n'existe pas."], Response::HTTP_NOT_FOUND); // Si le voyageur ne fait pas partie du voyage, ce message est retourné.
        }

        $jsonContent = $request->getContent();
        $updatedItem = $serializer->deserialize($jsonContent, Item::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $item]);

        $errors = $validator->validate($updatedItem);

        if (count($errors)) {
            return $this->json(["message" => "Erreur lors de la modification de l'item", "errors" => $errors], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $entityManager->flush();

        return $this->json(["message" => "Item modifié !"], Response::HTTP_OK, [], ['groups' => "get_item"]);
    }

    #[Route('/item/{id<\d+>}', name: 'api_item_delete_item', methods: ["DELETE"])]
    public function delete(
        Item $item,
        EntityManagerInterface $entityManager,
        UserVerification $userVerification
    ): JsonResponse {

        if (!$userVerification->trip($item->getTrip())) {
            return $this->json(["message" => "Le voyage demandée n'existe pas."], Response::HTTP_NOT_FOUND); // Si le voyageur ne fait pas partie du voyage, ce message est retourné.
        }

        $entityManager->remove($item);
        $entityManager->flush();

        return $this->json(["message" => "Item supprimé !"], Response::HTTP_OK, [], ['groups' => "get_item"]);
    }
}
