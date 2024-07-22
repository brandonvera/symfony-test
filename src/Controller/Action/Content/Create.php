<?php

declare(strict_types=1);

namespace App\Controller\Action\Content;

use App\Entity\Content;
use App\Service\Content\CreateContentService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class Create
{
    private CreateContentService $createContentService;
    private TokenStorageInterface $tokenStorageInterface;

    public function __construct(CreateContentService $createContentService,TokenStorageInterface $tokenStorageInterface)
    {
        //inicializando el servicio de crear contenido
        $this->createContentService = $createContentService;
        $this->tokenStorageInterface = $tokenStorageInterface;
    }

    public function __invoke(Request $request): Content
    {
        $currentUser = $this->tokenStorageInterface->getToken()->getUser();

        return $this->createContentService->create($request, $currentUser);
    }
}