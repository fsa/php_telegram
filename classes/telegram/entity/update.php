<?php

/**
 * Telegram Bot API 4.9
 */

namespace Telegram\Entity;

class Update {

    public $update_id;
    public $message;
    public $edited_message;
    public $channel_post;
    public $edited_channel_post;
    public $inline_query;
    public $chosen_inline_result;
    public $callback_query;
    public $shipping_query;
    public $pre_checkout_query;
    public $poll;
    public $poll_answer;
    public $unsupported=[];

    public function __construct($json) {
        $update=json_decode($json, true);
        foreach ($update as $key=> $value) {
            switch ($key) {
                case 'update_id':
                    $this->update_id=intval($value);
                    break;
                case 'message':
                    $this->message=new Message($value);
                    break;
                case 'edited_message':
                    $this->edited_message=new Message($value);
                    break;
                case 'channel_post':
                    $this->channel_post=new Message($value);
                    break;
                case 'edited_channel_post':
                    $this->edited_channel_post=new Message($value);
                    break;
                case 'inline_query':
                    $this->inline_query=new InlineQuery($value);
                    break;
                case 'chosen_inline_result':
                    $this->chosen_inline_result=new ChosenInlineResult($value);
                    break;
                case 'callback_query':
                    $this->callback_query=new CallbackQuery($value);
                    break;
                case 'shipping_query':
                    $this->shipping_query=new ShippingQuery($value);
                    break;
                case 'pre_checkout_query':
                    $this->pre_checkout_query=new PreCheckoutQuery($value);
                    break;
                case 'poll':
                    $this->poll=new Poll($value);
                    break;
                case 'poll_answer':
                    $this->poll_answer=new PollAnswer($value);
                    break;
                default:
                    $this->unsupported[$key]=$value;
            }
        }
    }

}
