<?php

namespace App\Service;

use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserFinder
{
    public function __construct(
        private TokenStorageInterface $tokenStorageInterface, 
        private JWTTokenManagerInterface $jwtManager,
        private UserRepository $userRepository) {}

    public function findTheUser()
    {
        if(null === $this->tokenStorageInterface->getToken())
        {
            return null;
        }

        $decodedJwtToken = $this->jwtManager->decode($this->tokenStorageInterface->getToken());

        $user = $this->userRepository->findBy(["email" => $decodedJwtToken["username"]]);

        return $user[0];
    }
}