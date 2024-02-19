<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Service\UserFinder;
use App\Repository\UserRepository;
use App\Service\ImageHandler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


#[Route("/api/user")]
class UserController extends AbstractController
{
    private ?User $user;

    public function __construct(UserFinder $userFinder)
    {
        $this->user = $userFinder->findTheUser();
    }

    #[Route('/search', name: 'api_user_search', methods: ['POST'])]
    public function searchUser(
        UserRepository $userRepository,
        Request $request,
    ): JsonResponse {

        $jsonContent = $request->getContent();
        $email = json_decode($jsonContent, true);

        $user = $userRepository->findFriendByEmail($email["email"]);

        return $this->json(($user ? $user : ["message" => "Aucun utilisateur trouvé avec cet email"]), Response::HTTP_OK, [],  ["groups" => ["get_users"]]);
    }

    #[Route('/me', name: 'api_user_me', methods: ['GET'])]
    public function me(Request $request): JsonResponse
    {
        return $this->json($this->user, Response::HTTP_OK, [],  ["groups" => ["get_user"]]);
    }

    #[Route("/me/add_avatar", name: "api_user_add_avatar", methods: ["POST"])]
    public function addAvatar(
        Request $request,
        EntityManagerInterface $entityManager,
        ImageHandler $imageHandler
    ): JsonResponse {

        $jsonContent = $request->getContent();

        if($jsonContent === null)
        {
            return $this->json(["message" => "Vous devez ajouter un avatar !"], Response::HTTP_OK);
        }

        $jsonDecoded = json_decode($jsonContent, true);

        if ($base64String = $jsonDecoded["avatar"]) {
            if($this->user->getAvatar()) {
                $imageHandler->deleteImage($this->user->getAvatar());
                $this->user->setAvatarURL('');
            }
            $fileName =  $imageHandler->processUploadBase64($base64String, 'avatar');
            $this->user->setAvatar($fileName);

            $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath()  . '/uploads/images/';
            $this->user->setAvatarURL($baseurl . $this->user->getAvatar());
        }

        $entityManager->flush();

        return $this->json(["message" => "avatar créé !"], Response::HTTP_OK);
    }

    #[Route("/me/delete_avatar", name: "api_user_delete_avatar", methods: ["POST"])]
    public function deleteAvatar(
        EntityManagerInterface $entityManager,
        ImageHandler $imageHandler
    ): JsonResponse {

        if(!($this->user->getAvatar())) {
            return $this->json(["message" => "Cet utilisateur n'a pas encore d'avatar."], Response::HTTP_OK);
        }

        $imageHandler->deleteImage($this->user->getAvatar());
        $this->user->setAvatarURL('');
        $entityManager->flush();

        return $this->json(["message" => "Avatar supprimé !"], Response::HTTP_OK);
    }

    #[Route('/add', name: 'api_user_add', methods: ['POST'])]
    public function add(
        Request $request,
        SerializerInterface $serializer,
        UserRepository $userRepository,
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator,
        UserPasswordHasherInterface $passwordHasher,
    ): JsonResponse {
        
        if (!(null === $this->user)) {
            return $this->json(["message" => "Vous êtes déjà connecté, vous ne pouvez pas créer un compte."], Response::HTTP_FORBIDDEN);
        }

        $jsonContent = $request->getContent();
        $newUser = $serializer->deserialize($jsonContent, User::class, 'json');

        $hashPassword = $passwordHasher->hashPassword($newUser, $newUser->getPassword());
        $newUser->setPassword($hashPassword);
        $newUser->setRoles(["ROLE_USER"]);
        $newUser->setCreatedAt(new \DateTimeImmutable());

        $errors = $validator->validate($newUser);

        if (count($errors))
        {
            return $this->json(["message" => $errors], Response::HTTP_UNPROCESSABLE_ENTITY); 
        }

        $entityManager->persist($newUser);
        $entityManager->flush();

        return $this->json(["user" => $newUser, "message" => "utilisateur créé !"], Response::HTTP_OK);
    }

    #[Route('/me/update', name: 'api_user_edit', methods: ['PUT'])]
    public function edit(
        Request $request,
        SerializerInterface $serializer,
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator,
        UserPasswordHasherInterface $passwordHasher,
    ): JsonResponse {
        if (null === $this->user) {
            return $this->json(["message" => "Cet utilisateur n'existe pas"], Response::HTTP_FORBIDDEN); // Nous ne souhaitons pas faire savoir si le voyaage existe ou non
        }

        $jsonContent = $request->getContent();

        $modifiedUser = $serializer->deserialize($jsonContent, User::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $this->user]);

        if ($modifiedUser->getPassword()) {
            $hashPassword = $passwordHasher->hashPassword($modifiedUser, $modifiedUser->getPassword());
            $modifiedUser->setPassword($hashPassword);
        }

        $modifiedUser->setUpdatedAt(new \DateTimeImmutable());

        $errors = $validator->validate($modifiedUser);

        if (count($errors)) {
            return $this->json(["message" => "Erreur lors de la modification du compte"], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $entityManager->flush();

        return $this->json($modifiedUser, Response::HTTP_OK);
    }


    #[Route('/delete', name: 'api_user_delete', methods: ['DELETE'])]
    public function delete(EntityManagerInterface $entityManager): JsonResponse
    {
        if ($this->user === null) {
            return $this->json(["message" => "Cet utilisateur n'existe pas"], Response::HTTP_FORBIDDEN); // Nous ne souhaitons pas faire savoir si le voyaage existe ou non
        }

        $entityManager->remove($this->user);
        $entityManager->flush();

        return $this->json(["message" => "Utilisateur supprimé."], Response::HTTP_OK);
    }
}
