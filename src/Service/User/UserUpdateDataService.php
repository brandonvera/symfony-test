<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\Exception\ORMException;


class UserUpdateDataService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function updateData(String $name, User $user): ?User
    {
        //llamando a repository de user
        return $this->userRepository->updateUser($user->getId(), $name);
    }
}