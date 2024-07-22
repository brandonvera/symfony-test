<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Content;

class ContentRepository extends BaseRepository
{
    protected static function entityClass(): string
    {
        return Content::class;
    }

    public function save(Content $content): void
    {
        $this->saveEntity($content);
    }
}