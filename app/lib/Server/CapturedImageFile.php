<?php

require_once(ROOT_DIR . 'lib/Server/UploadedFile.php');

/**
 * Represents an image captured from camera (base64 encoded)
 * Mimics UploadedFile interface but for in-memory captured images
 */
class CapturedImageFile
{
    private $fileName;
    private $mimeType;
    private $size;
    private $contents;
    private $extension;

    /**
     * @param string $fileName
     * @param string $mimeType
     * @param int $size
     * @param string $contents Binary content
     * @param string $extension
     */
    public function __construct($fileName, $mimeType, $size, $contents, $extension)
    {
        $this->fileName = $fileName;
        $this->mimeType = $mimeType;
        $this->size = $size;
        $this->contents = $contents;
        $this->extension = $extension;
    }

    /**
     * @return string
     */
    public function OriginalName()
    {
        return $this->fileName;
    }

    /**
     * @return string
     */
    public function TemporaryName()
    {
        // No temporary file for captured images
        return '';
    }

    /**
     * @return string
     */
    public function MimeType()
    {
        return $this->mimeType;
    }

    /**
     * @return int total bytes
     */
    public function Size()
    {
        return $this->size;
    }

    /**
     * @return string
     */
    public function Extension()
    {
        return $this->extension;
    }

    /**
     * @return string
     */
    public function Contents()
    {
        return $this->contents;
    }

    public function IsError()
    {
        return false;
    }

    public function Error()
    {
        return '';
    }
}
