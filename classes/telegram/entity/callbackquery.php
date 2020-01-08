<?php

/**
 * Telegram API 4.5
 */

namespace Telegram\Entity;

class CallbackQuery {

    public $id;
    public $from;
    public $message;
    public $inline_message_id;
    public $chat_instance;
    public $data;
    public $game_short_name;
    public $unsupported=[];

    public function __construct(array $callback_query) {
        foreach ($callback_query as $key=> $value) {
            switch ($key) {
                case 'id':
                    $this->id=$value;
                    break;
                case 'from':
                    $this->from=new User($value);
                    break;
                case 'message':
                    $this->message=new Message($value);
                    break;
                case 'inline_message_id':
                    $this->inline_message_id=$value;
                    break;
                case 'chat_instance':
                    $this->chat_instance=$value;
                    break;
                case 'data':
                    $this->data=$value;
                    break;
                case 'game_short_name':
                    $this->game_short_name=$value;
                    break;
                default:
                    $this->unsupported[$key]=$value;
            }
        }
    }

}
