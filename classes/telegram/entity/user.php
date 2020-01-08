<?php

/**
 * Telegram Bot API 4.5
 */

namespace Telegram\Entity;

class User {

    public $id;
    public $is_bot;
    public $first_name;
    public $last_name;
    public $username;
    public $language_code;
    public $unsupported=[];

    public function __construct(array $user) {
        foreach ($user as $key=> $value) {
            switch ($key) {
                case 'id':
                    $this->id=intval($value);
                    break;
                case 'is_bot':
                    $this->is_bot=$value;
                    break;
                case 'first_name':
                    $this->first_name=$value;
                    break;
                case 'last_name':
                    $this->last_name=$value;
                    break;
                case 'username':
                    $this->username=$value;
                    break;
                case 'language_code':
                    $this->language_code=$value;
                    break;
                default:
                    $this->unsupported[$key]=$value;
            }
        }
    }

}
