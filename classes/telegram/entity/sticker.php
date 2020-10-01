<?php

/**
 * Telegram Bot API 4.9
 */

namespace Telegram\Entity;

class Sticker {

    public $file_id;
    public $file_unique_id;
    public $width;
    public $height;
    public $is_animated;
    public $thumb;
    public $emoji;
    public $set_name;
    public $mask_position;
    public $file_size;
    public $unsupported=[];

    public function __construct(array $sticker=null) {
        if (is_null($sticker)) {
            return;
        }
        foreach ($sticker as $key=> $value) {
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
                case 'is_animated':
                    $this->is_animated=boolval($value);
                    break;
                case 'thumb':
                    $this->thumb=new PhotoSize($value);
                    ;
                    break;
                case 'emoji':
                    $this->emoji=$value;
                    break;
                case 'set_name':
                    $this->set_name=$value;
                    break;
                case 'mask_position':
                    $this->mask_position=new MaskPosition($value);
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
