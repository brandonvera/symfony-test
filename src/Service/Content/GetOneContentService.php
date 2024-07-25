<?php

declare(strict_types=1);

namespace App\Service\Content;

use App\Entity\Content;
use App\Repository\ContentRepository;

class GetOneContentService
{
    private ContentRepository $contentRepository;

    public function __construct(ContentRepository $contentRepository)
    {
        $this->contentRepository = $contentRepository;
    }

    public function getContent($contentId): Content
    {
        return $this->contentRepository->getOneContent($contentId);
    }
}