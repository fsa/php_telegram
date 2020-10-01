<?php

/**
 * Telegram Bot API 4.9
 */

namespace Telegram\Entity;

class Audio {

    public $file_id;
    public $file_unique_id;
    public $duration;
    public $performer;
    public $title;
    public $mime_type;
    public $file_size;
    public $thumb;
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
                case 'duration':
                    $this->duration=intval($value);
                    break;
                case 'performer':
                    $this->performer=$value;
                    break;
                case 'title':
                    $this->title=$value;
                    break;
                case 'mime_type':
                    $this->mime_type=$value;
                    break;
                case 'file_size':
                    $this->file_size=intval($value);
                    break;
                case 'thumb':
                    $this->thumb=new PhotoSize($value);
                    break;
                default:
                    $this->unsupported[$key]=$value;
            }
        }
    }

}
