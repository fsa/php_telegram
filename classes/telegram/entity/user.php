<?php

/**
 * Telegram Bot API 4.9
 */

namespace Telegram\Entity;

class User {

    public $id;
    public $is_bot;
    public $first_name;
    public $last_name;
    public $username;
    public $language_code;
    public $can_join_groups;
    public $can_read_all_group_messages;
    public $supports_inline_queries;
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
                case 'can_join_groups':
                    $this->can_join_groups=$value;
                    break;
                case 'can_read_all_group_messages':
                    $this->can_read_all_group_messages=$value;
                    break;
                case 'upports_inline_queries':
                    $this->supports_inline_queries=$value;
                    break;
                default:
                    $this->unsupported[$key]=$value;
            }
        }
    }

}
