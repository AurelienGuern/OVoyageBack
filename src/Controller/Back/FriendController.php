<?php

namespace App\Controller\Back;

use App\Entity\Friend;
use App\Form\FriendType;
use App\Repository\FriendRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/back/friend')]
class FriendController extends AbstractController
{
    #[Route('/', name: 'app_back_friend_index', methods: ['GET'])]
    public function index(FriendRepository $friendRepository): Response
    {
        return $this->render('back/friend/index.html.twig', [
            'friends' => $friendRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_back_friend_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $friend = new Friend();
        $form = $this->createForm(FriendType::class, $friend);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($friend);
            $entityManager->flush();

            return $this->redirectToRoute('app_back_friend_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/friend/new.html.twig', [
            'friend' => $friend,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_friend_show', methods: ['GET'])]
    public function show(Friend $friend): Response
    {
        return $this->render('back/friend/show.html.twig', [
            'friend' => $friend,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_back_friend_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Friend $friend, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FriendType::class, $friend);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_back_friend_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/friend/edit.html.twig', [
            'friend' => $friend,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_friend_delete', methods: ['POST'])]
    public function delete(Request $request, Friend $friend, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$friend->getId(), $request->request->get('_token'))) {
            $entityManager->remove($friend);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_back_friend_index', [], Response::HTTP_SEE_OTHER);
    }
}
