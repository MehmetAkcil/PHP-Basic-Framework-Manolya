<?php
namespace Core\Config;

use Config\Exception;

class FileUploader
{
    private $allowedExtensions = [
        'image' => ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp'],
        'audio' => ['mp3', 'wav', 'wma', 'aac', 'ogg'],
        'video' => ['mp4', 'avi', 'mkv', 'wmv', 'flv', 'mov'],
        'document' => ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt'],
        'archive' => ['zip', 'rar', 'tar', 'gz', '7z'],
        'json' => ['json']
    ];
    private $maxFileSize = 10485760; // 10MB
    private $uploadDirectory = 'Public/Uploads/';

    public function __construct($allowedExtensions = [], $maxFileSize = 0, $uploadDirectory = '')
    {
        if (!empty($allowedExtensions)) {
            $this->allowedExtensions = $allowedExtensions;
        }
        if (!empty($maxFileSize)) {
            $this->maxFileSize = $maxFileSize;
        }
        if (!empty($uploadDirectory)) {
            $this->uploadDirectory = $uploadDirectory;
        }
    }

    public function setAllowedExtensions($allowedExtensions)
    {
        $this->allowedExtensions = $allowedExtensions;
    }

    public function setMaxFileSize($maxFileSize)
    {
        $this->maxFileSize = $maxFileSize;
    }

    public function setUploadDirectory($uploadDirectory)
    {
        $this->uploadDirectory = $uploadDirectory;
    }

    public function uploadFile($file, $fileType)
    {
        $this->validateFile($file, $fileType);
        $newFileName = $this->generateNewFileName($file);
        $uploadPath = $this->uploadDirectory . $newFileName;
        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            return $uploadPath;
        } else {
            throw new Exception('Dosya yüklenirken bir hata oluştu.');
        }
    }

    private function validateFile($file, $fileType)
    {
        $fileName = $file['name'];
        $fileSize = $file['size'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($fileExtension, $this->allowedExtensions[$fileType])) {
            throw new Exception('Dosya uzantısı geçersiz.');
        }

        if ($fileSize > $this->maxFileSize) {
            throw new Exception('Dosya boyutu çok büyük.');
        }
    }

    private function generateNewFileName($file)
    {
        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $newFileName = md5_file($file['tmp_name']) . '.' . $fileExtension;
        return $newFileName;
    }
}