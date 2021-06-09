<?php

/**
 * Telegram Bot API 5.0
 */

namespace Telegram;

class Webhook {

    private static $chat_id;
    private static $admin_id;
    private static $json;
    private static Entity\Update $update;

    public static function setAdminChat($admin_id) {
        if (!$admin_id) {
            return;
        }
        self::$admin_id=$admin_id;
        self::setExceptionHandler($admin_id);
    }

    public static function getUpdate(): Entity\Update {
        self::$json=file_get_contents('php://input');
        self::$update=new Entity\Update(json_decode(self::$json, true, 512, JSON_THROW_ON_ERROR));
        return self::$update;
    }

    public static function getUpdateEntity(): Entity\Update {
        return self::$update;
    }

    public static function getRequestJson() {
        return self::$json;
    }

    public static function logRequet() {
        syslog(LOG_DEBUG, __FILE__.'('.__LINE__.') Telegram Bot API request: '.self::getRequestJson());
    }

    public static function setExceptionHandler($chat_id) {
        self::$chat_id=$chat_id;
        set_exception_handler([self::class, 'Exception']);
    }

    public static function Exception($ex) {
        $class=get_class($ex);
        $class_parts=explode('\\', $class);
        if (end($class_parts)=='UserException') {
            if (isset(self::$chat_id)) {
                $message=new SendMessage(self::$chat_id, $ex->getMessage(), 'HTML');
                $message->webhookReplyJson();
            }
            exit;
        }
        syslog(LOG_ERR, $ex.PHP_EOL."Request: ".self::$json);
        if (isset(self::$admin_id)) {
            if (isset(self::$chat_id)) {
                $admin=new SendMessage(self::$admin_id, "Произошла ошибка у пользователя ".self::$chat_id."\n".$ex, 'HTML');
            } else {
                $admin=new SendMessage(self::$admin_id, "Произошла ошибка\n".$ex, 'HTML');
            }
            $admin->httpPost();
        }
        if (isset(self::$chat_id)) {
            $message=new SendMessage(self::$chat_id, 'Что-то пошло не так.', 'HTML');
            $message->webhookReplyJson();
            exit;
        }
    }

}
