<?php

declare(strict_types=1);

namespace App\Controller\Action\User;

use App\Entity\User;
use App\Service\Request\RequestService;
use App\Service\User\UserRegisterService;
use Symfony\Component\HttpFoundation\Request;

class Register
{
    private UserRegisterService $userRegisterService;

    public function __construct(UserRegisterService $userRegisterService)
    {
        //inicializando el servicio de registro
        $this->userRegisterService = $userRegisterService;
    }

    //custom action para registro de usuario
    public function __invoke(Request $request): User
    {
        //llamada al servicio
        return $this->userRegisterService->create(
            RequestService::getField($request, 'name'),
            RequestService::getField($request, 'email'),
            RequestService::getField($request, 'password')
        );
    }
}