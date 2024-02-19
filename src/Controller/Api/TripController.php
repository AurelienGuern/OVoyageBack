<?php

namespace App\Controller\Api;

use App\Entity\Trip;
use App\Entity\User;
use App\Repository\CityRepository;
use App\Service\UserFinder;
use App\Service\ImageHandler;
use App\Service\UserVerification;
use App\Repository\UserRepository;
use App\Repository\FriendRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api')]
class TripController extends AbstractController
{

    private User $user;

    public function __construct(UserFinder $userFinder)
    {
        $this->user = $userFinder->findTheUser();
    }

    #[Route('/mytrips', name: 'api_trip_user', methods: ["GET"])]
    public function browseByUser(): JsonResponse
    {
        return $this->json($this->user->getTrips(), Response::HTTP_OK, [], ["groups" => ["get_trips"]]);
    }

    #[Route('/trip/{id<\d+>}', name: 'api_trip_read', methods: ['GET'])]
    public function read(
        Request $request,
        UserVerification $userVerification,
        Trip $trip = null,
        ): JsonResponse
    {
        if (null === $trip) {
            return $this->json(["message" => "Le voyage demandée n'existe pas"], Response::HTTP_NOT_FOUND);
        }

        if (!$userVerification->trip($trip)) {
            return $this->json(["message" => "Le voyage demandée n'existe pas."], Response::HTTP_NOT_FOUND); // Si le voyageur ne fait pas partie du voyage, ce message est retourné.
        }

        return $this->json($trip, Response::HTTP_OK, [], ['groups' => ["get_trip"]]); 
    }

    #[Route("/trip/{id}/add_picture", name: "api_trip_add_picture", methods: ["POST"])]
    public function addPicture(
        Request $request,
        Trip $trip,
        EntityManagerInterface $entityManager,
        ImageHandler $imageHandler
    ): JsonResponse {

        $jsonContent = $request->getContent();
        $jsonDecoded = json_decode($jsonContent, true);

        if ($base64String = $jsonDecoded["picture"]) {
            if($trip->getBackgroundPicture()) {
                $imageHandler->deleteImage($trip->getBackgroundPicture());
                $trip->setBackgroundPictureURL('');
            }
            $fileName =  $imageHandler->processUploadBase64($base64String, 'trip');
            $trip->setBackgroundPicture($fileName);

            $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath()  . '/uploads/images/';
            $trip->setBackgroundPictureURL($baseurl . $trip->getBackgroundPicture());
        }

        $entityManager->flush();

        return $this->json(["message" => "Image de voyage créé !"], Response::HTTP_OK);
    }

    #[Route("/trip/{id}/delete_picture", name: "api_trip_delete_picture", methods: ["POST"])]
    public function deletePicture(
        Trip $trip,
        EntityManagerInterface $entityManager,
        ImageHandler $imageHandler
    ): JsonResponse {

        if(!($trip->getBackgroundPicture())) {
            return $this->json(["message" => "Ce voyage n'a pas encore d'image."], Response::HTTP_OK);
        }

        $imageHandler->deleteImage($trip->getBackgroundPicture());
        $trip->setBackgroundPictureURL('');
        $entityManager->flush();

        return $this->json(["message" => "Image de voyage supprimé !"], Response::HTTP_OK);
    }

    #[Route('/trip/add', name: 'api_trip_new', methods: ['POST'])]
    public function add(
        Request $request,
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
    ): JsonResponse {

        // TODO: Remplacer le UserFinder par le $this->getUser(); comme stipulé ci-dessous dans l'ensemble des entités
        /* @var $user App\Entity\User */
        // $user = $this->getUser();

        $jsonContent = $request->getContent();
        $newTrip = $serializer->deserialize($jsonContent, Trip::class, 'json');

        $newTrip->setCreatedAt(new \DateTimeImmutable());
        $newTrip->setAdmin($this->user);

        if(!$newTrip->getBackgroundPicture())
        {
            foreach($newTrip->getCities() as $city)
            {
                $newTrip->setBackgroundPictureURL($city->getCountry()->getCountryPictureURL());
                $newTrip->setBackgroundPicture($city->getCountry()->getCountryPicture());
                break;
            }
        }

        $errors = $validator->validate($newTrip);

        if (count($errors)) {
            return $this->json(["message" => "Erreur lors de la création du voyage"], Response::HTTP_UNPROCESSABLE_ENTITY); 
        }

        $entityManager->persist($newTrip);
        $entityManager->flush();

        return $this->json($newTrip->getId(), Response::HTTP_CREATED);
    }

    #[Route('/trip/{id<\d+>}', name: 'api_trip_edit', methods: ['PUT'])]
    public function edit(
        Trip $trip = null,
        Request $request,
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        CityRepository $cityRepository
    ): JsonResponse {

        if ($trip === null) {
            return $this->json(["message" => "Cet utilisateur ne fait pas partie de ce voyage"], Response::HTTP_FORBIDDEN); // Nous ne souhaitons pas faire savoir si le voyaage existe ou non
        }

        if (!($trip->getAdmin() === $this->user)) {
            return $this->json(["message" => "Cet utilisateur ne fait pas partie de ce voyage"], Response::HTTP_FORBIDDEN);  // La modification d'un voyage n'est possible que si l'utilisateur est admin 
        }

        $jsonContent = $request->getContent();
        $updatedtrip = $serializer->deserialize($jsonContent, Trip::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $trip]);

        $updatedtrip->setUpdateAt(new \DateTimeImmutable());
        $updatedtrip->setAdmin($this->user);

        $errors = $validator->validate($updatedtrip);

        if (count($errors)) {
            return $this->json(["message" => "Erreur lors de la modification du voyage"], Response::HTTP_UNPROCESSABLE_ENTITY); // TODO: A modifier
        }

        $entityManager->flush();

        return $this->json($updatedtrip, Response::HTTP_OK, [], ['groups' => 'trip_detail', "get_trip"]);
    }

    #[Route('/trip/{id<\d+>}', name: 'api_trip_delete', methods: ['DELETE'])]
    public function delete(Trip $trip = null, EntityManagerInterface $entityManager): JsonResponse
    {
        if ($trip === null) {
            return $this->json(["message" => "Cet utilisateur ne fait pas partie de ce voyage"], Response::HTTP_FORBIDDEN); // Nous ne souhaitons pas faire savoir si le voyaage existe ou non
        }

        if (!($trip->getAdmin() === $this->user)) {
            return $this->json(["message" => "Cet utilisateur ne fait pas partie de ce voyage"], Response::HTTP_FORBIDDEN);  // La modification d'un voyage n'est possible que si l'utilisateur est admin 
        }

        $entityManager->remove($trip);
        $entityManager->flush();

        return $this->json(["message" => "Ce voyage a bien été supprimé."], Response::HTTP_OK);
    }

    #[Route('/trip/{id<\d+>}/addcity', name: 'api_trip_add_city', methods: ['PUT'])]
    // TODO: Implémenter un voter
    public function addCity(
        Trip $trip = null,
        Request $request,
        EntityManagerInterface $em,
        CityRepository $cityRepository,
        UserRepository $userRepository
    ): JsonResponse {

        if ($trip === null) {
            return $this->json(["message" => "Voyage inexistant !"], Response::HTTP_FORBIDDEN); // Nous ne souhaitons pas faire savoir si le voyaage existe ou non
        }

        if ($trip->getAdmin() !== $this->user) {
            return $this->json(["message" => "Seul le créateur du voyage peut faire cette action."], Response::HTTP_FORBIDDEN);
        }


        $jsonContent = $request->getContent();
        $getCity = json_decode($jsonContent, true);

        if(!($city = $cityRepository->find($getCity["city"])))
        {
            return $this->json(["message" => "La ville demandée n'existe pas !"], Response::HTTP_OK);
        }

        foreach($trip->getCities() as $tripCity)
        {
            if($tripCity === $city)
            {
                return $this->json(["message" => "Cette ville fait déjà partie du voyage !"], Response::HTTP_OK);
            }
        }  
        
        $trip->addCity($city);
        $em->flush();

        return $this->json(["message" => "Cette ville a bien été ajouté au voyage !"], Response::HTTP_OK);
    }

    #[Route('/trip/{id<\d+>}/removecity', name: 'api_trip_remove_city', methods: ['DELETE'])]
    // TODO: Implémenter un voter
    public function removeCity(
        Trip $trip = null,
        Request $request,
        EntityManagerInterface $em,
        CityRepository $cityRepository,
    ): JsonResponse {

        if ($trip === null) {
            return $this->json(["message" => "Voyage inexistant !"], Response::HTTP_FORBIDDEN); // Nous ne souhaitons pas faire savoir si le voyaage existe ou non
        }

        if ($trip->getAdmin() !== $this->user) {
            return $this->json(["message" => "Seul le créateur du voyage peut faire cette action."], Response::HTTP_FORBIDDEN);
        }

        $jsonContent = $request->getContent();
        $getCity = json_decode($jsonContent, true);

        $city = $cityRepository->find($getCity["city"]);

        foreach($trip->getCities() as $tripCity)
        {
            if($city === $tripCity)
            {
                $trip->removeCity($city);
                $em->flush();
                return $this->json(["message" => "La ville a bien été supprimé du voyage"], Response::HTTP_FORBIDDEN);
            }
        }

        return $this->json(["message" => "Cette ville ne fait pas partie du voyage !"], Response::HTTP_FORBIDDEN);
    }

    #[Route('/trip/{id<\d+>}/addTraveler', name: 'api_trip_add_traveler', methods: ['PUT'])]
    // TODO: Implémenter un voter
    public function addTraveler(
        Trip $trip = null,
        Request $request,
        EntityManagerInterface $em,
        FriendRepository $friendRepository,
        UserRepository $userRepository
    ): JsonResponse {

        if ($trip === null) {
            return $this->json(["message" => "Voyage inexistant !"], Response::HTTP_FORBIDDEN); // Nous ne souhaitons pas faire savoir si le voyaage existe ou non
        }

        if ($trip->getAdmin() !== $this->user) {
            return $this->json(["message" => "Seul le créateur du voyage peut faire cette action."], Response::HTTP_FORBIDDEN);
        }

        $jsonContent = $request->getContent();
        $IDofTheTravelerToAdd = json_decode($jsonContent, true);
        $searchForFriendship = $friendRepository->findBy(["user1" => $this->user, "user2" => $IDofTheTravelerToAdd]);

        if (null === $searchForFriendship) {
            return $this->json(["message" => "Vous n'êtes pas amis avec cette personne."], Response::HTTP_FORBIDDEN);
        }

        if ($searchForFriendship[0]->isRelationship() !== true) {
            return $this->json(["message" => "Vous n'êtes pas encore amis avec cette personne, la demande est toujours en attente de validation."], Response::HTTP_FORBIDDEN);
        }

        foreach ($trip->getTravelers() as $traveler) {
            if ($traveler === $searchForFriendship[0]->getUser2()) {
                return $this->json(["message" => "Ce voyageur fait déjà partie de votre voyage !"], Response::HTTP_FORBIDDEN);
            }
        }

        $trip->addTraveler($searchForFriendship[0]->getUser2());
        $em->flush();

        return $this->json(["message" => "Ce voyageur a bien été ajouté au voyage !"], Response::HTTP_OK);
    }

    

    #[Route('/trip/{id<\d+>}/removeTraveler', name: 'api_trip_remove_traveler', methods: ['DELETE'])]
    // TODO: Implémenter un voter
    public function removeTraveler(
        Trip $trip = null,
        Request $request,
        EntityManagerInterface $em,
        UserRepository $userRepository,
    ): JsonResponse {

        if ($trip === null) {
            return $this->json(["message" => "Voyage inexistant !"], Response::HTTP_FORBIDDEN); // Nous ne souhaitons pas faire savoir si le voyaage existe ou non
        }

        if ($trip->getAdmin() !== $this->user) {
            return $this->json(["message" => "Seul le créateur du voyage peut faire cette action."], Response::HTTP_FORBIDDEN);
        }

        $jsonContent = $request->getContent();
        $IDofTheTravelerToRemove = json_decode($jsonContent, true);

        $userToFind = $userRepository->find($IDofTheTravelerToRemove);

        foreach ($trip->getTravelers() as $traveler) {
            if ($traveler === $userToFind) {
                $trip->removeTraveler($userToFind);
                $em->flush();

                return $this->json(["message" => "Ce voyageur a bien été supprimé au voyage !"], Response::HTTP_OK);
            }
        }

        return $this->json(["message" => "Ce voyageur ne fait pas partie de votre voyage !"], Response::HTTP_FORBIDDEN);
    }

    #[Route('/trip/{id<\d+>}/showTravelers', name: 'api_trip_show_travelers', methods: ["GET"])]
    public function showTravelers(
        Trip $trip = null,
        UserVerification $userVerification
        ): JsonResponse
    {
        if ($trip === null) {
            return $this->json(["message" => "Le voyage demandée n'existe pas."], Response::HTTP_FORBIDDEN); // Nous ne souhaitons pas faire savoir si le voyaage existe ou non
        }

        if (!$userVerification->trip($trip)) {
            return $this->json(["message" => "Le voyage demandée n'existe pas."], Response::HTTP_NOT_FOUND); // Si le voyageur ne fait pas partie du voyage, ce message est retourné.
        }
        return $this->json($trip->getTravelers(), Response::HTTP_OK, [], ["groups" => ["get_travelers"]]);
    }

    #[Route('/trip/{id<\d+>}/leaveTrip', name: 'api_trip_leave_trip', methods: ['DELETE'])]
    public function leaveTrip(
        Trip $trip = null, 
        EntityManagerInterface $em,
        Request $request,
        UserRepository $userRepository,
        UserVerification $userVerification
        ): JsonResponse
    {
        if ($trip === null) {
            return $this->json(["message" => "Voyage inexistant !"], Response::HTTP_NOT_FOUND); // Nous ne souhaitons pas faire savoir si le voyaage existe ou non
        }

        if (!$userVerification->trip($trip)) {
            return $this->json(["message" => "Le voyage demandée n'existe pas."], Response::HTTP_NOT_FOUND); // Si le voyageur ne fait pas partie du voyage, ce message est retourné.
        }

        if ($this->user === $trip->getAdmin()) 
        {
            $jsonContent = $request->getContent();
            $idOfTheUserToFind = json_decode($jsonContent, true);

            $userToFind = null;

            if($idOfTheUserToFind)
            {
                $userToFind = $userRepository->find($idOfTheUserToFind["id"]);
            }

            foreach($trip->getTravelers() as $traveler)
            {
                if($traveler === $userToFind)
                {
                    $trip->setAdmin($userToFind);
                    break;
                }
            }

            if($this->user === $trip->getAdmin())
            {
                return $this->json(["message" => "Vous devez choisir un voyageur qui est dans le voyage."], Response::HTTP_FORBIDDEN);
            }
        }

        $trip->removeTraveler($this->user);
        $em->flush();

        return $this->json(["message" => "Vous avez quitté le voyage."], Response::HTTP_OK);
    }

}
