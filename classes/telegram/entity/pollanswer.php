<?php

/**
 * Telegram API 4.6
 */

namespace Telegram\Entity;

class PollAnswer {

    public $poll_id;
    public $user;
    public $option_ids;
    public $unsupported=[];

    public function __construct(array $user) {
        foreach ($user as $key=> $value) {
            switch ($key) {
                case 'poll_id':
                    $this->poll_id=$value;
                    break;
                case 'user':
                    $this->user=new User($value);
                    break;
                case 'option_ids':
                    $this->option_ids=$value;
                    break;
                default:
                    $this->unsupported[$key]=$value;
            }
        }
    }

}
