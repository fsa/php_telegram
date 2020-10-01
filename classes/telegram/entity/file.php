<?php

/**
 * Telegram Bot API 4.9
 */

namespace Telegram\Entity;

class File {

    public $file_id;
    public $file_unique_id;
    public $file_size;
    public $file_path;
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
                case 'file_size':
                    $this->file_size=intval($value);
                    break;
                case 'file_path':
                    $this->file_path=$value;
                    break;
                default:
                    $this->unsupported[$key]=$value;
            }
        }
    }

}
