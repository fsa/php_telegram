<?php

/**
 * Telegram API 4.5
 */

namespace Telegram\Entity;

class MessageEntity {

    public $type;
    public $offset;
    public $length;
    public $url;
    public $user;
    public $unsupported=[];

    public function __construct(array $message_entity) {
        foreach ($message_entity as $key=> $value) {
            switch ($key) {
                case 'type':
                    $this->type=$value;
                    break;
                case 'offset':
                    $this->offset=intval($value);
                    break;
                case 'length':
                    $this->length=intval($value);
                    break;
                case 'url':
                    $this->url=$value;
                    break;
                case 'user':
                    $this->user=new User($value);
                    break;
                default:
                    $this->unsupported[$key]=$value;
            }
        }
    }

}
