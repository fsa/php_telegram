<?php

/**
 * Telegram Bot API 4.9
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
    public $explanation;
    public $explanation_entities;
    public $open_period;
    public $close_date;
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
                case 'explanation':
                    $this->explanation=$value;
                    break;
                case 'explanation_entities':
                    foreach ($value as $entity) {
                        $this->explanation_entities[]=new MessageEntity($entity);
                    }
                    break;
                case 'open_period':
                    $this->open_period=intval($value);
                    break;
                case 'close_date':
                    $this->close_date=intval($value);
                    break;
                default:
                    $this->unsupported[$key]=$value;
            }
        }
    }

}
