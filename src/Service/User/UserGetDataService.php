<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserGetDataService
{
    private TokenStorageInterface $tokenStorageInterface;

    /**
     * @param TokenStorageInterface $tokenStorageInterface
     */
    public function __construct(TokenStorageInterface $tokenStorageInterface) {
        $this->tokenStorageInterface = $tokenStorageInterface;
    }

    public function getData(): User
    {
        $currentUser = $this->tokenStorageInterface->getToken()->getUser();

        return $currentUser;
    }
}