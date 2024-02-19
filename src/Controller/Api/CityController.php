<?php

namespace App\Controller\Api;

use App\Entity\City;
use App\Repository\CityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/city')]
class CityController extends AbstractController
{
    #[Route('/', name: 'api_city_browse', methods: ['GET'])]
    public function browse(Request $request, CityRepository $cityRepository): JsonResponse
    {
        $cities = $cityRepository->findAll();
        $modifiedCitiesImageForCountries = [];
        foreach($cities as $city)
        {
            if($city->getCountry()->getCountryPicture())
            {
            $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath()  . '/uploads/images/';
    
            $city->getCountry()->setCountryPicture($baseurl . $city->getCountry()->getCountryPicture());
            }
            $modifiedCitiesImageForCountries[] = $city;
        }
        return $this->json($modifiedCitiesImageForCountries, Response::HTTP_OK, [], ['groups' => 'get_cities']);
    }

    #[Route('/{id<\d+>}', name: 'api_city_read', methods: ['GET'])]
    public function read(Request $request, City $city): JsonResponse
    {
        if($city->getCountry()->getCountryPicture())
        {
            $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath()  . '/uploads/images/';
    
            $city->getCountry()->setCountryPicture($baseurl . $city->getCountry()->getCountryPicture());
        }
        return $this->json($city, Response::HTTP_OK, [], ['groups' => 'get_city']);
    }

    
}
