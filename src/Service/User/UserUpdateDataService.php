<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\Password\EncoderService;
use Symfony\Component\Security\Core\User\UserInterface;

class UserUpdateDataService
{
    private UserRepository $userRepository;
    private EncoderService $encoderService;

    public function __construct(UserRepository $userRepository, EncoderService $encoderService,) {
        $this->userRepository = $userRepository;
        $this->encoderService = $encoderService;
    }

    public function updateData(String $name, String $email, String $currentPassword, String $newPassword, User $user): ?User
    {
        //validando si la password actual coincide
        if (!$this->encoderService->isValidPassword($user, $currentPassword)) {
            throw new \Exception('Current password do not match');
        }
        //encode nueva password
        $encodeNewPass = $this->encoderPassword($user, $newPassword);
        return $this->userRepository->updateUser($user->getId(), $name, $email, $encodeNewPass);
    }

    public function encoderPassword(UserInterface $user, string $plainPassword): string
    {
        return $this->encoderService->generateEncodedPassword($user, $plainPassword);
    }
}