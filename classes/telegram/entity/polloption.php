<?php

/**
 * Telegram API 4.5
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
                    $this->voter_count=$value;
                    break;
                default:
                    $this->unsupported[$key]=$value;
            }
        }
    }

}
