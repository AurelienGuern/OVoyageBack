<?php

namespace App\Controller\Api;

use App\Entity\Country;
use App\Service\ImageHandler;
use App\Repository\CountryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/country')]
class CountryController extends AbstractController
{
    #[Route('/', name: 'api_country_browse', methods: ['GET'])]
    public function browse(Request $request, CountryRepository $countryRepository): JsonResponse
    {
        return $this->json($countryRepository->findAll(), Response::HTTP_OK, [], ['groups' => 'get_countries']);
    }

    #[Route('/{id<\d+>}/cities', name: 'api_country_read', methods: ['GET'])]
    public function browseByCountry(Request $request, Country $country): JsonResponse
    {
        return $this->json($country, Response::HTTP_OK, [], ['groups' => 'get_cities']);
    }

    #[Route("/{id<\d+>}/add_picture", name: "api_country_add_picture", methods: ["POST"])]
    public function addAvatar(
        Country $country,
        Request $request,
        EntityManagerInterface $entityManager,
        ImageHandler $imageHandler
    ): JsonResponse {

        $jsonContent = $request->getContent();
        $jsonDecoded = json_decode($jsonContent, true);

        if ($base64String = $jsonDecoded["picture"]) {
            if($country->getCountryPicture()) {
                $imageHandler->deleteImage($country->getCountryPicture());
                $country->setCountryPictureURL('');
            }
            $fileName =  $imageHandler->processUploadBase64($base64String, 'country');
            $country->setCountryPicture($fileName);

            $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath()  . '/uploads/images/';
            $country->setCountryPictureURL($baseurl . $country->getCountryPicture());
        }

        $entityManager->flush();

        return $this->json(["message" => "avatar créé !"], Response::HTTP_OK);
    }

    #[Route("/{id<\d+>}/delete_picture", name: "api_country_delete_picture", methods: ["POST"])]
    public function deleteAvatar(
        Country $country,
        EntityManagerInterface $entityManager,
        ImageHandler $imageHandler
    ): JsonResponse {

        if(!($country->getCountryPicture())) {
            return $this->json(["message" => "Ce voyage n'a pas encore d'image."], Response::HTTP_OK);
        }

        $imageHandler->deleteImage($country->getCountryPicture());
        $country->setCountryPictureURL('');
        $entityManager->flush();

        return $this->json(["message" => "Image de voyage supprimé !"], Response::HTTP_OK);
    }
}
