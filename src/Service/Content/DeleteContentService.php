<?php

declare(strict_types=1);

namespace App\Service\Content;

use App\Entity\Content;
use App\Repository\ContentRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class DeleteContentService
{
    private ContentRepository $contentRepository;

    public function __construct(ContentRepository $contentRepository)
    {
        $this->contentRepository = $contentRepository;
    }

    public function deleteContent($contentId): JsonResponse
    {
        $content = $this->contentRepository->getOneContent($contentId);
        $delete = $this->contentRepository->deleteContent($content);

        if($delete == '' || $delete == []){
            return new JsonResponse("Content deleted succesfully");
        }
    }
}