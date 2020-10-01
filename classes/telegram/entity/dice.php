<?php

/**
 * Telegram Bot API 4.9
 */

namespace Telegram\Entity;

class Dice {

    public $emoji;
    public $value;
    public $unsupported=[];

    public function __construct(array $document=null) {
        if (is_null($document)) {
            return;
        }
        foreach ($document as $key=> $value) {
            switch ($key) {
                case 'emoji':
                    $this->emoji=$value;
                    break;
                case 'value':
                    $this->value=intval($value);
                    break;
                default:
                    $this->unsupported[$key]=$value;
            }
        }
    }

}
