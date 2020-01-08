<?php

/**
 * Telegram Bot API 4.5
 */

namespace Telegram\Entity;

class Venue {

    public $location;
    public $title;
    public $address;
    public $forsquare_id;
    public $forsquare_type;
    public $unsupported=[];

    public function __construct(array $user) {
        foreach ($user as $key=> $value) {
            switch ($key) {
                case 'location':
                    $this->location=new Location($value);
                    break;
                case 'title':
                    $this->title=$value;
                    break;
                case 'address':
                    $this->address=$value;
                    break;
                case 'forsquare_id':
                    $this->forsquare_id=$value;
                    break;
                case 'forsquare_type':
                    $this->forsquare_type=$value;
                    break;
                default:
                    $this->unsupported[$key]=$value;
            }
        }
    }

}
