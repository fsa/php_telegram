<?php

namespace Telegram\Api;

class SendMessage implements actionInterface {

    private $chat_id;
    private $text;
    private $parse_mode;
    private $disable_web_page_preview;
    private $disable_notification;
    private $reply_to_message_id;
    private $reply_markup;

    public function __construct(string $chat_id=null, string $text=null, string $parseMode=null) {
        if (!is_null($chat_id)) {
            $this->setChatId($chat_id);
        }
        if (!is_null($text)) {
            $this->setText($text);
        }
        switch ($parseMode) {
            case 'HTML':
                $this->setParseModeHTML();
                break;
            case 'Markdown':
                $this->setParseModeMarkdown();
                break;
            default:
        }
    }

    public function getActionName(): string {
        return 'sendMessage';
    }

    public function setChatId(string $id): void {
        $this->chat_id=$id;
    }

    public function setText(string $text): void {
        $this->text=$this->removeHtmlEntities($text);
    }
    
    public function appendText(string $text): void {
        if(is_null($this->text)) {
            $this->text=$this->removeHtmlEntities($text);
        } else {
            $this->text.=$this->removeHtmlEntities($text);
        }
    }

    private function removeHtmlEntities(string $text) {
        return str_replace(['&nbsp;', '&laquo;', '&raquo;', '&quot;', '&deg;'], [' ', '«', '»', '"', '°'], $text);
    }


    public function setParseModeMarkdown(): void {
        $this->parse_mode='Markdown';
    }

    public function setParseModeHTML(): void {
        $this->parse_mode='HTML';
    }

    public function setDisableWebPagePreview(bool $bool=true): void {
        $this->disable_web_page_preview=$bool;
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
        if (is_null($this->chat_id) or is_null($this->text)) {
            throw new Exception('Required: chat_id, text');
        }
        $query=[];
        $query['chat_id']=$this->chat_id;
        $query['text']=$this->text;
        if (!is_null($this->parse_mode)) {
            $query['parse_mode']=$this->parse_mode;
        }
        if (!is_null($this->disable_web_page_preview)) {
            $query['disable_web_page_preview']=$this->disable_web_page_preview;
        }
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
