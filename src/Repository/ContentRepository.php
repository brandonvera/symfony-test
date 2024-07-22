<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Content;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ContentRepository extends BaseRepository
{
    private ContainerInterface $containerInterface;

    protected static function entityClass(): string
    {
        return Content::class;
    }

    public function save(Content $content): void
    {
        $this->saveEntity($content);
    }

    public function updateContent($request, $id)
    {
        $content = $this->objectRepository->find($id);

        if (!$content) {
            throw new \Exception('Content not found');
        }

        $file = $request->files->get('file');
        
        if ($file !== null && $file instanceof UploadedFile) {
            $mimeType = $file->getMimeType();
            $fileName = uniqid(). '.'. $file->getClientOriginalExtension();
            $filePath = $this->containerInterface->getParameter('kernel.project_dir'). '/public/uploads/';

            $allowedTypes = [
                'image/jpeg',
                'image/png',
                'video/mp4',
            ];

            if (!in_array($mimeType, $allowedTypes)) {
                throw new \Exception('File Type not allowed');
            }

            if (strpos($mimeType, 'image/') === 0) {
                $filePath.= 'images/';
                $content->setType("Image");
            } elseif (strpos($mimeType, 'video/') === 0) {
                $filePath.= 'videos/';
                $content->setType("Video");
            }

            if ($file->getSize() > 50 * 1024 * 1024) {
                throw new \Exception('File size it is too big (max 50MB)');
            }

            $file->move($filePath, $fileName);
            $content->setFileName($fileName);
            $content->setFilePath($filePath);
            $content->setMimeType($mimeType);
        }

        $content->setTitle($request->get('title'));
        $content->setDescription($request->get('description'));
        
        $this->save($content);

        return $content;
    }
}