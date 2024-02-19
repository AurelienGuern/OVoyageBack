<?php

namespace App\Controller\Api;

use App\Entity\Tag;
use App\Entity\City;
use App\Entity\Trip;
use App\Entity\User;
use App\Entity\Activity;
use App\Repository\ActivityRepository;
use App\Repository\CityRepository;
use App\Repository\TagRepository;
use App\Service\UserFinder;
use App\Service\UserVerification;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api')]
class ActivityController extends AbstractController
{
    private User $user;

    public function __construct(UserFinder $userFinder)
    {
        $this->user = $userFinder->findTheUser();
    }

    #[Route('/trip/{id<\d+>}/activities/', name: 'api_activity_browse_trip', methods: ['GET'])]
    public function browseByTrip(
        Trip $trip = null,
        UserVerification $userVerification
    ): JsonResponse {
        if (null === $trip) {
            return $this->json(["message" => "Le voyage demandé n'existe pas."], Response::HTTP_NOT_FOUND);
        }

        if (!$userVerification->trip($trip)) {
            return $this->json(["message" => "Le voyage demandé n'existe pas."], Response::HTTP_NOT_FOUND); // Si le voyageur ne fait pas partie du voyage, ce message est retourné.
        }

        return $this->json($trip->getActivities(), Response::HTTP_OK, [], ["groups" => "get_activities"]);
    }

    #[Route('/trip/{id<\d+>}/activity/add', name: 'api_activity_post', methods: ['POST'])]
    public function add(
        Trip $trip = null,
        EntityManagerInterface $entityManager,
        Request $request,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        UserVerification $userVerification,
        CityRepository $cityRepository,
    ): JsonResponse {

        if (null === $trip) {
            return $this->json(["message" => "Le voyage demandé n'existe pas."], Response::HTTP_NOT_FOUND);
        }

        if (!$userVerification->trip($trip)) {
            return $this->json(["message" => "Le voyage demandé n'existe pas."], Response::HTTP_NOT_FOUND); // Si le voyageur ne fait pas partie du voyage, ce message est retourné.
        }

        // Récupérer les informations JSON
        $json = $request->getContent();

        $activity = $serializer->deserialize($json, Activity::class, 'json');
        $activity->setCreator($this->user);
        $activity->setTrip($trip);

        if ($activity->getDate()) {
            if ($activity->getDate() < $trip->getStartDate() || $activity->getDate() > $trip->getEndDate()) {
                return $this->json(["message" => "Vous ne pouvez pas mettre une activité en dehors des dates prévu du voyage."], Response::HTTP_NOT_FOUND); // Si le voyageur ne fait pas partie du voyage, ce message est retourné.
            }
        }

        $jsonArray = json_decode($json, true);
        $city = $cityRepository->find($jsonArray["city"]);

        if (!$city) {
            return $this->json(["message" => "La ville demandée n'existe pas."], Response::HTTP_NOT_FOUND); // Si le voyageur ne fait pas partie du voyage, ce message est retourné.
        }

        $cityFound = false;

        foreach ($trip->getCities() as $actualCity) {
            if ($actualCity === $city) {
                $cityFound = true;
            }
        }

        if (!$cityFound) {
            return $this->json(["message" => "La ville demandée n'existe pas dans le voyage."], Response::HTTP_NOT_FOUND); // Si le voyageur ne fait pas partie du voyage, ce message est retourné.
        }

        $activity->setCity($city);

        $errors = $validator->validate($activity);

        if (count($errors)) {
            return $this->json($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $entityManager->persist($activity);
        $entityManager->flush();

        return $this->json($activity, Response::HTTP_OK, [], ["groups" => "get_activity"]);
    }

    #[Route('/activity/{id<\d+>}', name: 'api_activity_read', methods: ['GET'])]
    public function read(
        Activity $activity = null,
        UserVerification $userVerification
    ): JsonResponse {

        if (null === $activity) {
            return $this->json(["message" => "L'activité demandée n'existe pas."], Response::HTTP_NOT_FOUND);
        }

        if (!$userVerification->trip($activity->getTrip())) {
            return $this->json("Le voyage demandé n'existe pas.", Response::HTTP_NOT_FOUND); // Si le voyageur ne fait pas partie du voyage, ce message est retourné.
        }

        return $this->json($activity, Response::HTTP_OK, [], ["groups" => "get_activity"]);
    }

    #[Route('/activity/{id<\d+>}', name: 'api_activity_edit', methods: ['PUT'])]
    public function edit(
        EntityManagerInterface $entityManager,
        Activity $activity = null,
        Request $request,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        UserVerification $userVerification
    ): JsonResponse {

        if (null === $activity) {
            return $this->json(['message' => "L'activité n'existe pas."], Response::HTTP_NOT_FOUND);
        }

        if (!$userVerification->trip($activity->getTrip())) {
            return $this->json("L'activité n'existe pas.", Response::HTTP_NOT_FOUND); // Si le voyageur ne fait pas partie du voyage, ce message est retourné.
        }

        $json = $request->getContent();

        $serializer->deserialize($json, Activity::class, 'json');

        $errors = $validator->validate($activity);

        if (count($errors)) {
            return $this->json($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $entityManager->flush();

        return $this->json($activity, Response::HTTP_OK, [], ['groups' => 'get_activity']);
    }

    #[Route('/activity/{id<\d+>}', name: 'api_activity_delete', methods: ['DELETE'])]
    public function delete(
        Activity $activity = null,
        EntityManagerInterface $entityManager,
        UserVerification $userVerification
    ): JsonResponse {

        if (null === $activity) {
            return $this->json(['message' => "L\'activité demandée n'existe pas"], Response::HTTP_NOT_FOUND);
        }

        if (!$userVerification->trip($activity->getTrip())) {
            return $this->json(["message" => "L'activité demandée n'existe pas."], Response::HTTP_NOT_FOUND); // Si le voyageur ne fait pas partie du voyage, ce message est retourné.
        }

        $entityManager->remove($activity);
        $entityManager->flush();
        return $this->json(['message' => "L'activité à bien été supprimé."], Response::HTTP_OK);
    }

    #[Route('/activity/{id<\d+>}/addtag', name: 'api_trip_add_tag', methods: ['PUT'])]
    public function addTag(
        Activity $activity = null,
        Request $request,
        EntityManagerInterface $em,
        TagRepository $tagRepository,
        UserVerification $userVerification
    ): JsonResponse {

        if (null === $activity) {
            return $this->json(['message' => "L'activité n'existe pas."], Response::HTTP_NOT_FOUND);
        }

        if (!$userVerification->trip($activity->getTrip())) {
            return $this->json("L'activité n'existe pas.", Response::HTTP_NOT_FOUND); // Si le voyageur ne fait pas partie du voyage, ce message est retourné.
        }

        $jsonContent = $request->getContent();
        $getTag = json_decode($jsonContent, true);

        if(!($tag = $tagRepository->find($getTag["tag"])))
        {
            return $this->json(["message" => "Le tag demandée n'existe pas !"], Response::HTTP_OK);
        }
        
        $activity->addTag($tag);
        $em->flush();

        return $this->json(["message" => "Le tag a bien été ajouté à l'activité !"], Response::HTTP_OK);
    }

    #[Route('/activity/{id<\d+>}/removetag', name: 'api_trip_remove_tag', methods: ['DELETE'])]
    public function removeTag(
        Activity $activity = null,
        Request $request,
        EntityManagerInterface $em,
        TagRepository $tagRepository,
        UserVerification $userVerification
    ): JsonResponse {

        if (null === $activity) {
            return $this->json(['message' => "L'activité n'existe pas."], Response::HTTP_NOT_FOUND);
        }

        if (!$userVerification->trip($activity->getTrip())) {
            return $this->json("L'activité n'existe pas.", Response::HTTP_NOT_FOUND); // Si le voyageur ne fait pas partie du voyage, ce message est retourné.
        }

        $jsonContent = $request->getContent();
        $getTag = json_decode($jsonContent, true);

        if(!($tag = $tagRepository->find($getTag["tag"])))
        {
            return $this->json(["message" => "La tag demandée n'existe pas !"], Response::HTTP_OK);
        }

        foreach($activity->getTags() as $tag)
        {
            if($tag === $tag)
            {
                $activity->removeTag($tag);
                $em->flush();
                return $this->json(["message" => "La tag a bien été supprimé de l'activité"], Response::HTTP_FORBIDDEN);
            }
        }

        return $this->json(["message" => "Le tag demandée n'existe pas !"], Response::HTTP_FORBIDDEN);
    }

    #[Route('/trip/{trip}/activities/tags/{tag}', name: 'api_activity_browse_tags', methods: ['GET'])]
    public function browseByTripThenTag(
        #[MapEntity(id: 'trip')]
        Trip $trip = null,
        #[MapEntity(id: 'tag')]
        Tag $tag = null,
        UserVerification $userVerification
    ): JsonResponse {
        if (null === $trip) {
            return $this->json(["message" => "Cet utilisateur ne fait pas partie de ce voyage"], Response::HTTP_FORBIDDEN); // Nous ne souhaitons pas faire savoir si le voyaage existe ou non
        }

        if (null === $tag) {
            return $this->json(['message' => "Le filtrage demandée n'existe pas"], Response::HTTP_NOT_FOUND);
        }

        if (!$userVerification->trip($trip)) {
            return $this->json(["message" => "Le voyage demandée n'existe pas."], Response::HTTP_NOT_FOUND); // Si le voyageur ne fait pas partie du voyage, ce message est retourné.
        }

        $activitiesWithTheTag = [];

        foreach ($trip->getActivities() as $activity) {
            foreach ($activity->getTags() as $actualTag) {
                if ($actualTag === $tag) {
                    $activitiesWithTheTag[] = $activity;
                }
            }
        }
        return $this->json($activitiesWithTheTag, Response::HTTP_OK, [], ["groups" => "filter"]);
    }

    #[Route('/trip/{trip}/activities/cities/{city}', name: 'api_activity_browse_tags', methods: ['GET'])]
    public function browseByTripThenCity(
        UserVerification $userVerification,
        #[MapEntity(id: 'trip')]
        Trip $trip = null,
        #[MapEntity(id: 'city')]
        City $city = null,
    ): JsonResponse {
        if (null === $trip) {
            return $this->json(["message" => "Cet utilisateur ne fait pas partie de ce voyage"], Response::HTTP_FORBIDDEN); // Nous ne souhaitons pas faire savoir si le voyaage existe ou non
        }

        if (null === $city) {
            return $this->json(['message' => "Le filtrage demandée n'existe pas"], Response::HTTP_NOT_FOUND);
        }

        if (!$userVerification->trip($trip)) {
            return $this->json(["message" => "Le voyage demandée n'existe pas."], Response::HTTP_NOT_FOUND); // Si le voyageur ne fait pas partie du voyage, ce message est retourné.
        }

        $activities = $trip->getActivities();

        $activitiesInTheCity = [];

        foreach ($activities as $activity) {
            if ($activity->getCity() === $city) {
                $activitiesInTheCity[] = $activity;
            }
        }

        return $this->json($activitiesInTheCity, Response::HTTP_OK, [], ["groups" => "filter"]);
    }

    #[Route('/trip/{id<\d+>}/activities/date/{date<\d{4}\-\d{2}\-\d{2}>}', name: 'api_activity_browse_day', methods: ['GET'])]
    public function browseByTripThenDay(
        UserVerification $userVerification,
        Trip $trip = null,
        \DateTimeImmutable $date = null,
    ): JsonResponse {
        if (null === $trip) {
            return $this->json(["message" => "Cet utilisateur ne fait pas partie de ce voyage"], Response::HTTP_FORBIDDEN); // Nous ne souhaitons pas faire savoir si le voyaage existe ou non
        }

        if (null === $date) {
            return $this->json(["message" => "Cette date n'est pas valide."], Response::HTTP_FORBIDDEN); // Nous ne souhaitons pas faire savoir si le voyaage existe ou non
        }

        if (!$userVerification->trip($trip)) {
            return $this->json(["message" => "Le voyage demandée n'existe pas."], Response::HTTP_NOT_FOUND); // Si le voyageur ne fait pas partie du voyage, ce message est retourné.
        }

        $activities = $trip->getActivities();

        $activitiesWithDate = [];

        foreach ($activities as $activity) {
            if ($activity->getdate()->format('Y-m-d') === $date->format('Y-m-d')) {
                $activitiesWithDate[] = $activity;
            }
        }
        return $this->json($activitiesWithDate, Response::HTTP_OK, [], ["groups" => "filter"]);
    }

    #[Route('/trip/{trip<\d+>}/activities/date/{date<\d{4}\-\d{2}\-\d{2}>}/tags/{tag}', name: 'api_activity_browse_day_tag', methods: ['GET'])]
    public function browseByTripThenDayThenTag(
        UserVerification $userVerification,
        #[MapEntity(id: 'trip')]
        Trip $trip = null,
        \DateTimeImmutable $date = null,
        #[MapEntity(id: 'tag')]
        Tag $tag = null
    ): JsonResponse {
        if (null === $trip) {
            return $this->json(["message" => "Cet utilisateur ne fait pas partie de ce voyage"], Response::HTTP_FORBIDDEN);
        }

        if (null === $date) {
            return $this->json(["message" => "Cette date n'est pas valide."], Response::HTTP_FORBIDDEN);
        }

        if (null === $tag) {
            return $this->json(["message" => "Ce filtre n'existe pas."], Response::HTTP_FORBIDDEN);
        }

        if (!$userVerification->trip($trip)) {
            return $this->json(["message" => "Le voyage demandée n'existe pas."], Response::HTTP_NOT_FOUND); // Si le voyageur ne fait pas partie du voyage, ce message est retourné.
        }

        $activities = $trip->getActivities();
        $activitiesWithDateAndTag = [];

        foreach ($activities as $activity) {
            if ($activity->getDate()->format('Y-m-d') === $date->format('Y-m-d')) {
                foreach ($activity->getTags() as $activityTag) {
                    // Comparaison des identifiants des tags
                    if ($activityTag == $tag) {
                        $activitiesWithDateAndTag[] = $activity;
                    }
                }
            }
        }

        return $this->json($activitiesWithDateAndTag, Response::HTTP_OK, [], ["groups" => "filter"]);
    }

    #[Route('/trip/{trip<\d+>}/activities/city/{city}/tags/{tag}', name: 'api_activity_browse_city_tag', methods: ['GET'])]
    public function browseByTripThenCityThenTag(
        #[MapEntity(id: 'trip')]
        Trip $trip = null,
        #[MapEntity(id: 'tag')]
        Tag $tag = null,
        #[MapEntity(id: 'city')]
        City $city = null,
        UserVerification $userVerification
    ): JsonResponse {
        if (null === $trip) {
            return $this->json(["message" => "Cet utilisateur ne fait pas partie de ce voyage"], Response::HTTP_FORBIDDEN);
        }

        if (null === $city) {
            return $this->json(["message" => "Cette ville n'est pas valide."], Response::HTTP_FORBIDDEN);
        }

        if (null === $tag) {
            return $this->json(["message" => "Ce filtre n'existe pas."], Response::HTTP_FORBIDDEN);
        }

        if (!$userVerification->trip($trip)) {
            return $this->json(["message" => "Le voyage demandée n'existe pas."], Response::HTTP_NOT_FOUND); // Si le voyageur ne fait pas partie du voyage, ce message est retourné.
        }

        $activities = $trip->getActivities();
        $activitiesWithCityAndTag = [];

        foreach ($activities as $activity) {
            if ($activity->getCity() === $city) {
                foreach ($activity->getTags() as $activityTag) {
                    // Comparaison des identifiants des tags
                    if ($activityTag === $tag) {
                        $activitiesWithCityAndTag[] = $activity;
                    }
                }
            }
        }

        return $this->json($activitiesWithCityAndTag, Response::HTTP_OK, [], ["groups" => "filter"]);
    }
}
