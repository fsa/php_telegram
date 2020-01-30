<?php

namespace Telegram\Api;

class SendSticker implements actionInterface {

    private $chat_id;
    private $sticker;
    private $disable_notification;
    private $reply_to_message_id;
    private $reply_markup;

    public function __construct(string $chat_id=null, string $sticker=null) {
        if (!is_null($chat_id)) {
            $this->setChatId($chat_id);
        }
        if (!is_null($sticker)) {
            $this->setSticker($sticker);
        }
    }

    public function getActionName(): string {
        return 'sendSticker';
    }

    public function setChatId(string $id): void {
        $this->chat_id=$id;
    }

    public function setSticker(string $sticker): void {
        $this->sticker=$sticker;
    }

    public function setDisableNotification(bool $bool=true): void {
        $this->disable_notification=$bool;
    }

    public function setReplyToMessageId(int $id): void {
        $this->reply_to_message_id=$id;
    }

    public function setReplyMarkup(\Telegram\Entity\KeyboardInterface $keyboard): void {
        $this->reply_markup=$keyboard;
    }

    public function buildQuery(): array {
        if (is_null($this->chat_id) or is_null($this->sticker)) {
            throw new Exception('Required: chat_id, sticker');
        }
        $query=[];
        $query['chat_id']=$this->chat_id;
        $query['sticker']=$this->sticker;
        if (!is_null($this->disable_notification)) {
            $query['disable_notification']=$this->disable_notification;
        }
        if (!is_null($this->reply_to_message_id)) {
            $query['reply_to_message_id']=$this->reply_to_message_id;
        }
        if (!is_null($this->reply_markup)) {
            $query['reply_markup']=$this->reply_markup->get();
        }
        return $query;
    }

}
