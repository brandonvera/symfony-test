<?php

declare(strict_types=1);

namespace App\Controller\Action\User;

use App\Entity\User;
use App\Service\Request\RequestService;
use App\Service\User\UserUpdateDataService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UpdateUser
{
    private UserUpdateDataService $userUpdateDataService;
    private TokenStorageInterface $tokenStorageInterface;

    public function __construct(UserUpdateDataService $userUpdateDataService,
        TokenStorageInterface $tokenStorageInterface
    )
    {
        //inicializando el servicio de actualizar
        $this->userUpdateDataService = $userUpdateDataService;
        $this->tokenStorageInterface = $tokenStorageInterface;
    }

    public function __invoke(Request $request): ?User
    {
        //obteniendo info del usuario a traves del token (debe estar logueado)
        $currentUser = $this->tokenStorageInterface->getToken()->getUser();
        
        //llamando al servicio de update
        return $this->userUpdateDataService->updateData(
            RequestService::getField($request, 'name'),
            $currentUser
        );
    }
}