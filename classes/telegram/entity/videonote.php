<?php

/**
 * Telegram Bot API 4.5
 */

namespace Telegram\Entity;

class VideoNote {

    public $file_id;
    public $file_unique_id;
    public $length;
    public $duration;
    public $thumb;
    public $file_size;
    public $unsupported=[];

    public function __construct(array $document=null) {
        if (is_null($document)) {
            return;
        }
        foreach ($document as $key=> $value) {
            switch ($key) {
                case 'file_id':
                    $this->file_id=$value;
                    break;
                case 'file_unique_id':
                    $this->file_unique_id=$value;
                    break;
                case 'length':
                    $this->length=intval($value);
                    break;
                case 'duration':
                    $this->duration=intval($value);
                    break;
                case 'thumb':
                    $this->thumb=new PhotoSize($value);
                    break;
                case 'file_size':
                    $this->file_size=intval($value);
                    break;
                default:
                    $this->unsupported[$key]=$value;
            }
        }
    }

}
