<?php

class ReservationAttachment
{
    /**
     * @var int
     */
    protected $fileId;

    /**
     * @var string
     */
    protected $fileName;

    /**
     * @var string
     */
    protected $fileType;

    /**
     * @var int
     */
    protected $fileSize;

    /**
     * @var string
     */
    protected $fileContent;

    /**
     * @var string
     */
    protected $fileExtension;

    /**
     * @var int
     */
    protected $seriesId;

    /**
     * @var string|null
     */
    protected $note;

    /**
     * @return int
     */
    public function FileId()
    {
        return $this->fileId;
    }

    /**
     * @return string
     */
    public function FileName()
    {
        return $this->fileName;
    }

    /**
     * @return string
     */
    public function FileContents()
    {
        return $this->fileContent;
    }

    /**
     * @return string
     */
    public function FileExtension()
    {
        return $this->fileExtension;
    }

    /**
     * @return int
     */
    public function FileSize()
    {
        return $this->fileSize;
    }

    /**
     * @return string
     */
    public function FileType()
    {
        return $this->fileType;
    }

    /**
     * @return int
     */
    public function SeriesId()
    {
        return $this->seriesId;
    }

    /**
     * @return string|null
     */
    public function Note()
    {
        return $this->note;
    }

    /**
     * @param string|null $note
     */
    public function WithNote($note)
    {
        $this->note = $note;
    }

    protected function __construct()
    {
    }

    /**
     * @static
     * @param string $fileName
     * @param string $fileType
     * @param int $fileSize
     * @param mixed $fileContent
     * @param string $fileExtension
     * @param int $seriesId
     * @param string|null $note
     * @return ReservationAttachment
     */
    public static function Create($fileName, $fileType, $fileSize, $fileContent, $fileExtension, $seriesId, $note = null)
    {
        $file = new ReservationAttachment();
        $file->fileName = $fileName;
        $file->fileType = $fileType;
        $file->fileSize = $fileSize;
        $file->fileContent = $fileContent;
        $file->fileExtension = $fileExtension;
        $file->seriesId = $seriesId;
        $file->note = $note;

        return $file;
    }

    /**
     * @param $fileId int
     */
    public function WithFileId($fileId)
    {
        $this->fileId = $fileId;
    }

    /**
     * @param $seriesId int
     */
    public function WithSeriesId($seriesId)
    {
        $this->seriesId = $seriesId;
    }
}
