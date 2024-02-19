<?php

namespace App\Service;

use App\Entity\User;

class UserVerification
{

    private ?User $user;

    public function __construct(UserFinder $userFinder) {
        $this->user = $userFinder->findTheUser();
    }

    public function trip($trip)
    {
        $authorizedAccess = false;

        foreach ($this->user->getTrips() as $actualTrip) {
            if ($trip === $actualTrip) {
                $authorizedAccess = true;
            }
        }

        return $authorizedAccess;
    }
}