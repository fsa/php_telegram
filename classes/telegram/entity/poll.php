<?php

/**
 * Telegram Bot API 4.6
 */

namespace Telegram\Entity;

class Poll {

    public $id;
    public $question;
    public $options=[];
    public $total_voter_count;
    public $is_closed;
    public $is_anonymous;
    public $type;
    public $allows_multiple_answers;
    public $correct_option_id;
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
                case 'total_voter_count':
                    $this->total_voter_count=intval($value);
                    break;
                case 'is_closed':
                    $this->is_closed=boolval($value);
                    break;
                case 'is_anonymous':
                    $this->is_anonymous=boolval($value);
                    break;
                case 'type':
                    $this->type=$value;
                    break;
                case 'allows_multiple_answers':
                    $this->allows_multiple_answers=boolval($value);
                    break;
                case 'correct_option_id':
                    $this->correct_option_id=intval($value);
                    break;
                default:
                    $this->unsupported[$key]=$value;
            }
        }
    }

}
