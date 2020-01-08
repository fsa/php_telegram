<?php

namespace Telegram;

class Request {

    private static $chat_id;

    public static function httpPost(Api\actionInterface $action): object {
        $api_url='https://api.telegram.org/bot'.\Settings::get('telegram')->token;
        $context=stream_context_create([
            'http'=>array(
                'method'=>'POST',
                'header'=>'Content-Type: application/x-www-form-urlencoded'.PHP_EOL,
                'content'=>http_build_query($action->buildQuery()),
            ),
        ]);
        $result=file_get_contents($api_url.'/'.$action->getActionName(), false, $context);
        if($result===false) {
            throw new Exception('Не удалось поучить данные для '.$action->getActionName());
        }
        return json_decode($result);
    }

    public static function httpGet(Api\actionInterface $action): object {
        $api_url='https://api.telegram.org/bot'.\Settings::get('telegram')->token;
        $result=file_get_contents($api_url.'/'.$action->getActionName().'?'.http_build_query($action->buildQuery()), false);
        if($result===false) {
            throw new Exception('Не удалось поучить данные для '.$action->getActionName());
        }
        return json_decode($result);
    }

    public static function getFileContent(string $file_id) {
        $api_url='https://api.telegram.org/file/bot'.\Settings::get('telegram')->token;
        $file=self::httpPost(new Api\GetFile($file_id));
        if(!$file->ok) {
            return null;
        }
        return file_get_contents($api_url.'/'.$file->result->file_path, false);
    }

    public static function webhookReplyJson(Api\actionInterface $action): void {
        $query=$action->buildQuery();
        $query['method']=$action->getActionName();
        header('Content-Type: application/json');
        echo json_encode($query, JSON_UNESCAPED_UNICODE);
    }

    public static function setWebhookExceptionHandler($chat_id) {
        self::$chat_id=$chat_id;
        set_exception_handler([__CLASS__, 'Exception']);
    }

    public static function Exception($ex) {
        switch (get_class($ex)) {
            case 'AppException':
                $message=$ex->getMessage();
                self::webhookReplyJson(new Api\SendMessage(self::$chat_id, $message, 'HTML'));
                exit;
            default:
                $admin_id=\Settings::get('telegram')->abuse;
                self::httpPost(new Api\SendMessage($admin_id, "Произошла ошибка у пользователя ".$admin_id."\n".$ex, 'HTML'));
                $message=$ex;
                self::webhookReplyJson(new Api\SendMessage(self::$chat_id, 'Программная ошибка.', 'HTML'));
        }
        exit;
    }

}
