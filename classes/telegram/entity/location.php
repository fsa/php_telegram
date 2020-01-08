<?php

/**
 * Telegram API 4.5
 */

namespace Telegram\Entity;

class Location {

    public $longitude;
    public $latitude;
    public $unsupported=[];

    public function __construct(array $user) {
        foreach ($user as $key=> $value) {
            switch ($key) {
                case 'longitude':
                    $this->longitude=$value;
                    break;
                case 'latitude':
                    $this->latitude=$value;
                    break;
                default:
                    $this->unsupported[$key]=$value;
            }
        }
    }

}
