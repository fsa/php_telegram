<?php

/**
 * Telegram API 4.5
 */

namespace Telegram\Entity;

class Contact {

    public $phone_number;
    public $first_name;
    public $last_name;
    public $user_id;
    public $vcard;
    public $unsupported=[];

    public function __construct(array $user) {
        foreach ($user as $key=> $value) {
            switch ($key) {
                case 'phone_number':
                    $this->phone_number=$value;
                    break;
                case 'first_name':
                    $this->first_name=$value;
                    break;
                case 'last_name':
                    $this->last_name=$value;
                    break;
                case 'user_id':
                    $this->user_id=intval($value);
                    break;
                case 'vcard':
                    $this->vcard=$value;
                    break;
                default:
                    $this->unsupported[$key]=$value;
            }
        }
    }

}
