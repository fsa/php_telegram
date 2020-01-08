<?php

/**
 * Telegram API 4.5
 */

namespace Telegram\Entity;

class PhotoSize {

    public $file_id;
    public $file_unique_id;
    public $width;
    public $height;
    public $file_size;
    public $unsupported=[];

    public function __construct(array $user) {
        foreach ($user as $key=> $value) {
            switch ($key) {
                case 'file_id':
                    $this->file_id=$value;
                    break;
                case 'file_unique_id':
                    $this->file_unique_id=$value;
                    break;
                case 'width':
                    $this->width=intval($value);
                    break;
                case 'height':
                    $this->height=intval($value);
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
