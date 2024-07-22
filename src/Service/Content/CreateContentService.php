<?php

declare(strict_types=1);

namespace App\Service\Content;

use App\Entity\Content;
use App\Entity\User;
use App\Repository\ContentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\MimeType\MimeTypeGuesser;

class CreateContentService
{
    private $uploadPath;
    private ContentRepository $contentRepository;
    private ContainerInterface $containerInterface;

    public function __construct($uploadPath, ContentRepository $contentRepository, ContainerInterface $containerInterface)
    {
        $this->contentRepository = $contentRepository;
        $this->containerInterface = $containerInterface;
        $this->uploadPath = $uploadPath;
    }

    /**
     * @Request({"multipart/form-data"})
     */
    public function create($request, User $user): Content
    {
        $content = new Content();

        $file = $request->files->get('file');
        
        if ($file instanceof UploadedFile) {
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

        $content->setUserId($user);
        $content->setTitle($request->get('title'));
        $content->setDescription($request->get('description'));

        $this->contentRepository->save($content);

        return $content;
    }
}