<?php

declare(strict_types=1);

namespace App\Entity;

use Symfony\Component\Uid\Uuid;

class Content
{
    private $id;
    private $user_id;
    private $type;
    private $title;
    private $description;
    private $file_name;
    private $file_path;
    private $mime_type;
    private $created_at;
    private $updated_at;

    public function __construct()
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->created_at = new \DateTime();
        $this->markAsUpdated();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getFileName()
    {
        return $this->file_name;
    }

    public function setFileName($file_name)
    {
        $this->file_name = $file_name;
    }

    public function getFilePath()
    {
        return $this->file_path;
    }

    public function setFilePath($file_path)
    {
        $this->file_path = $file_path;
    }

    public function getMimeType()
    {
        return $this->mime_type;
    }

    public function setMimeType($mime_type)
    {
        $this->mime_type = $mime_type;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    public function markAsUpdated(): void
    {
        $this->updated_at = new \DateTime();
    }

}