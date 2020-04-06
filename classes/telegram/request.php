<?php

namespace Telegram;

use Settings;

class Request {

    private static $chat_id;

    public static function httpPost(Api\actionInterface $action): object {
        $settings=Settings::get('telegram');
        $api_url='https://api.telegram.org/bot'.$settings['token'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url.'/'.$action->getActionName());
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        if(isset($settings['proxy'])) {
            curl_setopt($ch, CURLOPT_PROXY, $settings['proxy']);
        }
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $action->buildQuery());
        $result = curl_exec($ch);
        curl_close($ch);
        if($result===false) {
            throw new Exception('Не удалось поучить данные для '.$action->getActionName());
        }
        return json_decode($result);
    }

    public static function httpGet(Api\actionInterface $action): object {
        $settings=Settings::get('telegram');
        $api_url='https://api.telegram.org/bot'.$settings['token'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url.'/'.$action->getActionName().'?'.http_build_query($action->buildQuery()));
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        if(isset($settings['proxy'])) {
            curl_setopt($ch, CURLOPT_PROXY, $settings['proxy']);
        }
        $result = curl_exec($ch);
        curl_close($ch);
        if($result===false) {
            throw new Exception('Не удалось поучить данные для '.$action->getActionName());
        }
        return json_decode($result);
    }

    public static function getFileContent(string $file_id) {
        $settings=Settings::get('telegram');
        $api_url='https://api.telegram.org/file/bot'.$settings['token'];
        $file=self::httpPost(new Api\GetFile($file_id));
        if(!$file->ok) {
            return null;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url.'/'.$file->result->file_path);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        if(isset($settings['proxy'])) {
            curl_setopt($ch, CURLOPT_PROXY, $settings['proxy']);
        }
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public static function webhookReplyJson(Api\actionInterface $action): void {
        $query=$action->buildQuery();
        $query['method']=$action->getActionName();
        header('Content-Type: application/json');
        echo json_encode($query, JSON_UNESCAPED_UNICODE);
    }

    public static function setWebhookExceptionHandler($chat_id) {
        self::$chat_id=$chat_id;
        set_exception_handler([self::class, 'Exception']);
    }

    public static function Exception($ex) {
        switch (get_class($ex)) {
            case 'AppException':
                $message=$ex->getMessage();
                self::webhookReplyJson(new Api\SendMessage(self::$chat_id, $message, 'HTML'));
                exit;
            default:
                $admin_id=Settings::get('telegram')['abuse'];
                self::httpPost(new Api\SendMessage($admin_id, "Произошла ошибка у пользователя ".$admin_id."\n".$ex, 'HTML'));
                $message=$ex;
                self::webhookReplyJson(new Api\SendMessage(self::$chat_id, 'Программная ошибка.', 'HTML'));
        }
        exit;
    }

}
