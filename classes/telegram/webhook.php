<?php

/**
 * Telegram Bot API 5.0
 */

namespace Telegram;

class Webhook {

    private static $logger;
    private static $chat_id;
    private static $abuse;
    private static $json;
    private static Entity\Update $update;

    public static function setLogger($logger) {
        self::$logger=$logger;
    }

    public static function getUpdate(string $abuse=null): Entity\Update {
        self::$json=file_get_contents('php://input');
        if(isset($abuse)) {
            self::$abuse=$abuse;
            self::setExceptionHandler($abuse);
        }
        self::$update=new Entity\Update(json_decode(self::$json, true));
        return self::$update;
    }

    public static function getUpdateEntity(): Entity\Update {
        return self::$update;
    }

    public static function getRequestJson() {
        return self::$json;
    }

    public static function logRequest() {
        if(isset(self::$logger)) {
            self::$logger->debug(self::$json);
        }
    }

    public static function setExceptionHandler($chat_id) {
        self::$chat_id=$chat_id;
        set_exception_handler([self::class, 'Exception']);
    }

    public static function Exception($ex) {
        $class=get_class($ex);
        if($class=='AppException') {
            if(isset(self::$chat_id)) {
                $message=new Api\SendMessage(self::$chat_id, $ex->getMessage(), 'HTML');
                $message->webhookReplyJson();
            }
            exit;
        }
        if(isset(self::$logger)) {
            self::$logger->error($ex);
        }
        if(isset(self::$abuse)) {
            if(isset(self::$chat_id)) {
                $admin=new Api\SendMessage(self::$abuse, "Произошла ошибка у пользователя ".self::$chat_id."\n".$ex, 'HTML');
            } else {
                $admin=new Api\SendMessage(self::$abuse, "Произошла ошибка\n".$ex, 'HTML');
            }
            $admin->httpPost();
        }
        if(isset(self::$chat_id)) {
            $message=new Api\SendMessage(self::$chat_id, 'Что-то пошло не так.', 'HTML');
            $message->webhookReplyJson();
            exit;
        }
    }

}
