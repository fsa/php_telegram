<?php

namespace Telegram\Entity;

class InlineKeyboardButton {

    public $text;
    public $url;
    public $login_url;
    public $callback_data;
    public $switch_inline_query;
    public $switch_inline_query_current_chat;
    public $callback_game;
    public $pay;
    
    public function __construct($text) {
        $this->text=$text;
    }
    
    public function setText(string $text) {
        $this->text=$text;        
    }

    public function setUrl(string $url) {
        $this->url=$url;
    }
    
    public function setLoginUrl(LoginUrl $login_url) {
        $this->login_url=$login_url;
    }
    
    public function setCallbackData(string $callback_data) {
        $this->callback_data=$callback_data;
    }
    
    public function setSwitchInlineQuery(string $switch_inline_query) {
        $this->switch_inline_query=$switch_inline_query;
    }
    
    public function setSwitchInlineQueryCurrentChat(string $switch_inline_query_current_chat) {
        $this->switch_inline_query_current_chat=$switch_inline_query_current_chat;
    }
    
    public function setCallbackGame(CallbackGame $callback_game) {
        $this->callback_game=$callback_game;
    }
    
    public function Pay(bool $pay) {
        $this->pay=$pay;
    }
    
    public function get() {
        $result['text']=$this->text;
        if(!is_null($this->url)) {
            $result['url']=$this->url;
        }
        if(!is_null($this->login_url)) {
            $result['login_url']=$this->login_url->get();
        }
        if(!is_null($this->callback_data)) {
            $result['callback_data']=$this->callback_data;
        }
        if(!is_null($this->switch_inline_query)) {
            $result['switch_inline_query']=$this->switch_inline_query;
        }
        if(!is_null($this->switch_inline_query_current_chat)) {
            $result['switch_inline_query_current_chat']=$this->switch_inline_query_current_chat;
        }
        if(!is_null($this->callback_game)) {
            $result['callback_game']=$this->callback_game->get();
        }
        if(!is_null($this->pay)) {
            $result['pay']=$this->pay;
        }
        return $result;
    }
            
}
