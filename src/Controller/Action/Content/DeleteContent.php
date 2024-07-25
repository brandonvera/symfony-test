<?php

declare(strict_types=1);

namespace App\Controller\Action\Content;

use App\Entity\Content;
use App\Service\Content\DeleteContentService;
use Symfony\Component\HttpFoundation\JsonResponse;

class DeleteContent
{
    private DeleteContentService $deleteContentService;

    public function __construct(DeleteContentService $deleteContentService)
    {
        $this->deleteContentService = $deleteContentService;
    }

    public function __invoke($id): JsonResponse
    {
        return $this->deleteContentService->deleteContent($id);  
    }
}