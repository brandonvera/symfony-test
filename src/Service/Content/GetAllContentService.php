<?php

declare(strict_types=1);

namespace App\Service\Content;

use App\Entity\Content;
use App\Repository\ContentRepository;

class GetAllContentService
{
    private ContentRepository $contentRepository;

    public function __construct(ContentRepository $contentRepository)
    {
        $this->contentRepository = $contentRepository;
    }

    public function getContent($title, $description, $user): Array
    {
        return $this->contentRepository->getAllContent($title, $description, $user);
    }
}