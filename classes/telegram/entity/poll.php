<?php

/**
 * Telegram Bot API 4.5
 */

namespace Telegram\Entity;

class Poll {

    public $id;
    public $question;
    public $options=[];
    public $is_closed;
    public $unsupported=[];

    public function __construct(array $user) {
        foreach ($user as $key=> $value) {
            switch ($key) {
                case 'id':
                    $this->id=intval($value);
                    break;
                case 'question':
                    $this->question=$value;
                    break;
                case 'options':
                    foreach ($value as $poll_option) {
                        $this->options[]=new PollOption($poll_option);
                    }
                    break;
                case 'is_closed':
                    $this->is_closed=boolval($value);
                    break;
                default:
                    $this->unsupported[$key]=$value;
            }
        }
    }

}
