<?php

declare(strict_types=1);

namespace App\Controller\Action\Content;

use App\Entity\Content;
use App\Service\Content\GetOneContentService;

class GetOneContent
{
    private GetOneContentService $getOneContentService;

    public function __construct(GetOneContentService $getOneContentService)
    {
        $this->getOneContentService = $getOneContentService;
    }

    public function __invoke($id): Content
    {
        return $this->getOneContentService->getContent($id);
    }
}