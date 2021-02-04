<?php

/**
 * Telegram Bot API 5.0
 */

namespace Telegram;

use Logger,
    Settings;

class Webhook {

    private static $chat_id;
    private $json;

    public function __construct() {
        $this->json=file_get_contents('php://input');
    }

    public function getRequest() {
        return $this->json;
    }

    public function getUpdate(): Entity\Update {
        return new Entity\Update(json_decode($this->json, true));
    }

    public function setExceptionHandler($chat_id) {
        self::$chat_id=$chat_id;
        set_exception_handler([self::class, 'Exception']);
    }

    public static function Exception($ex) {
        switch (get_class($ex)) {
            case 'AppException':
                $message=new Api\SendMessage(self::$chat_id, $ex->getMessage(), 'HTML');
                $message->webhookReplyJson();
                exit;
            default:
                $admin=new Api\SendMessage(Settings::get('telegram')['abuse'], "Произошла ошибка у пользователя ".self::$chat_id."\n".$ex, 'HTML');
                $admin->httpPost();
                Logger::error('telegram', $ex);
                $message=new Api\SendMessage(self::$chat_id, 'Программная ошибка при выполнении запроса.', 'HTML');
                $message->webhookReplyJson();
        }
        exit;
    }

}
