<?php

namespace App\Controller\Back;

use App\Entity\City;
use App\Form\CityType;
use App\Repository\CityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/back/city')]
class CityController extends AbstractController
{
    #[Route('/', name: 'app_back_city_index', methods: ['GET'])]
    public function index(CityRepository $cityRepository): Response
    {
        return $this->render('back/city/index.html.twig', [
            'cities' => $cityRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_back_city_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $city = new City();
        $form = $this->createForm(CityType::class, $city);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($city);
            $entityManager->flush();

            return $this->redirectToRoute('app_back_city_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/city/new.html.twig', [
            'city' => $city,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_city_show', methods: ['GET'])]
    public function show(City $city): Response
    {
        return $this->render('back/city/show.html.twig', [
            'city' => $city,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_back_city_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, City $city, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CityType::class, $city);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_back_city_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/city/edit.html.twig', [
            'city' => $city,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_city_delete', methods: ['POST'])]
    public function delete(Request $request, City $city, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$city->getId(), $request->request->get('_token'))) {
            $entityManager->remove($city);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_back_city_index', [], Response::HTTP_SEE_OTHER);
    }
}
