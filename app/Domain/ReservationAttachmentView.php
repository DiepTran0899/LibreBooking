<?php

class ReservationAttachmentView
{
    private int $fileId;
    private int $seriesId;
    private string $fileName;
    private ?string $note;

    /**
     * @param int $fileId
     * @param int $seriesId
     * @param string $fileName
     * @param string|null $note
     */
    public function __construct($fileId, $seriesId, $fileName, $note = null)
    {
        $this->fileId = $fileId;
        $this->seriesId = $seriesId;
        $this->fileName = $fileName;
        $this->note = $note;
    }

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
     * @return bool
     */
    public function IsImage()
    {
        $ext = strtolower(pathinfo($this->fileName, PATHINFO_EXTENSION));
        return in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp']);
    }
}
