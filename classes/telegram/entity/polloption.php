<?php

/**
 * Telegram API 4.9
 */

namespace Telegram\Entity;

class PollOption {

    public $text;
    public $voter_count;
    public $unsupported=[];

    public function __construct(array $user) {
        foreach ($user as $key=> $value) {
            switch ($key) {
                case 'text':
                    $this->text=$value;
                    break;
                case 'voter_count':
                    $this->voter_count=intval($value);
                    break;
                default:
                    $this->unsupported[$key]=$value;
            }
        }
    }

}
