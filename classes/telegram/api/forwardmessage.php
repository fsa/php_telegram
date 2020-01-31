<?php

namespace Telegram\Api;

class ForwardMessage implements actionInterface {

    private $chat_id;
    private $from_chat_id;
    private $disable_notification;
    private $message_id;

    public function __construct(string $chat_id=null, string $from_chat_id=null, int $message_id=null, bool $disable_notification=null) {
        if (!is_null($chat_id)) {
            $this->setChatId($chat_id);
        }
        if (!is_null($from_chat_id)) {
            $this->setFromChatId($from_chat_id);
        }
        if (!is_null($message_id)) {
            $this->setMessageId($message_id);
        }
        if (!is_null($disable_notification)) {
            $this->setDisableNotification($disable_notification);
        }
    }

    public function getActionName(): string {
        return 'forwardMessage';
    }

    public function setChatId(string $id): void {
        $this->chat_id=$id;
    }

    public function setFromChatId(string $id): void {
        $this->from_chat_id=$id;
    }

    public function setDisableNotification(bool $bool=true): void {
        $this->disable_notification=$bool;
    }

    public function setMessageId(int $id) {
        $this->message_id=$id;
    }

    public function buildQuery(): array {
        if (is_null($this->chat_id) or is_null($this->from_chat_id) or is_null($this->message_id)) {
            throw new Exception('Required: chat_id, from_chat_id, message_id');
        }
        $query=[];
        $query['chat_id']=$this->chat_id;
        $query['from_chat_id']=$this->from_chat_id;
        if (!is_null($this->disable_notification)) {
            $query['disable_notification']=$this->disable_notification;
        }
        $query['message_id']=$this->message_id;
        return $query;
    }

}
