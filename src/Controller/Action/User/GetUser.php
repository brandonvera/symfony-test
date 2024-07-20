<?php

declare(strict_types=1);

namespace App\Controller\Action\User;

use App\Entity\User;
use App\Service\User\UserGetDataService;
use Symfony\Component\HttpFoundation\Request;

class GetUser
{
    private UserGetDataService $userGetDataService;

    public function __construct(UserGetDataService $userGetDataService)
    {
        //inicializando el servicio de obtener info
        $this->userGetDataService = $userGetDataService;
    }

    public function __invoke(Request $request): User
    {
        return $this->userGetDataService->getData();
    }
}