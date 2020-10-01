<?php

/**
 * Telegram Bot API 4.9
 */

namespace Telegram\Entity;

class InlineKeyboardMarkup implements KeyboardInterface {

    private $buttons=[];
    private $row;

    public function __construct(array $buttons=null) {
        if (!is_null($buttons)) {
            $this->buttons=$buttons;
        }
        $this->row=0;
    }

    public function addButton(InlineKeyboardButton $button) {
        $this->buttons[$this->row][]=$button->get();
    }

    public function nextRow() {
        $this->row++;
    }

    public function get() {
        return json_encode(['inline_keyboard'=>$this->buttons], JSON_UNESCAPED_UNICODE);
    }

}
