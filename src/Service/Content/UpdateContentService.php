<?php

declare(strict_types=1);

namespace App\Service\Content;

use App\Entity\Content;
use App\Repository\ContentRepository;
use Symfony\Component\HttpFoundation\Request;

class UpdateContentService
{
    private ContentRepository $contentRepository;

    public function __construct(ContentRepository $contentRepository)
    {
        $this->contentRepository = $contentRepository;
    }

    /**
     * @Request({"multipart/form-data"})
     */
    public function update($request, $id): Content
    {
        return $this->contentRepository->updateContent($request, $id);
    }
}