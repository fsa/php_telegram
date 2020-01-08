<?php

/**
 * Telegram API 4.5
 */

namespace Telegram\Entity;

class Chat {

    public $id;
    public $type;
    public $title;
    public $username;
    public $first_name;
    public $last_name;
    public $all_members_are_administrators;
    public $photo;
    public $description;
    public $invite_link;
    public $pinned_message;
    public $permissions;
    public $slow_mode_delay;
    public $sticker_set_name;
    public $can_set_sticker_set;
    public $unsupported=[];

    public function __construct(array $chat) {
        foreach ($chat as $key=> $value) {
            switch ($key) {
                case 'id':
                    $this->id=intval($value);
                    break;
                case 'type':
                    $this->type=$value;
                    break;
                case 'title':
                    $this->title=$value;
                    break;
                case 'username':
                    $this->username=$value;
                    break;
                case 'first_name':
                    $this->first_name=$value;
                    break;
                case 'last_name':
                    $this->last_name=$value;
                    break;
                case 'photo':
                    $this->photo=new ChatPhoto($value);
                    break;
                case 'description':
                    $this->description=$value;
                    break;
                case 'invite_link':
                    $this->invite_link=$value;
                    break;
                case 'pinned_message':
                    $this->last_name=new Message($value);
                    break;
                case 'permissions':
                    $this->permissions=new ChatPermissions($value);
                    break;
                case 'slow_mode_delay':
                    $this->slow_mode_delay=intval($value);
                    break;
                case 'sticker_set_name':
                    $this->sticker_set_name=$value;
                    break;
                case 'can_set_sticker_set':
                    $this->can_set_sticker_set=$value;
                    break;
                default:
                    $this->unsupported[$key]=$value;
            }
        }
    }

}
