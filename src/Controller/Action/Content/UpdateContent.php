<?php

declare(strict_types=1);

namespace App\Controller\Action\Content;

use App\Entity\Content;
use App\Service\Content\UpdateContentService;
use Symfony\Component\HttpFoundation\Request;

class UpdateContent
{
    private UpdateContentService $updateContentService;

    public function __construct(UpdateContentService $updateContentService)
    {
        $this->updateContentService = $updateContentService;
    }

    public function __invoke(Request $request, $id): Content
    {
        return $this->updateContentService->update($request, $id);
    }
}