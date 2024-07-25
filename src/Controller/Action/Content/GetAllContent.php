<?php

declare(strict_types=1);

namespace App\Controller\Action\Content;

use App\Entity\Content;
use App\Service\Content\GetAllContentService;
use Symfony\Component\HttpFoundation\Request;
use App\Service\Request\RequestService;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class GetAllContent
{
    private GetAllContentService $getAllContentService;
    private TokenStorageInterface $tokenStorageInterface;

    public function __construct(GetAllContentService $getAllContentService, TokenStorageInterface $tokenStorageInterface)
    {
        $this->getAllContentService = $getAllContentService;
        $this->tokenStorageInterface = $tokenStorageInterface;
    }

    public function __invoke(Request $request): Array
    {
        $currentUser = $this->tokenStorageInterface->getToken()->getUser();
        return $this->getAllContentService->getContent(
            RequestService::getField($request, 'title'),
            RequestService::getField($request, 'description'),
            $currentUser);
    }
}