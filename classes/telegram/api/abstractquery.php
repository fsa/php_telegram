<?php

/**
 * Telegram Bot API 5.0
 */

namespace Telegram\Api;

use Settings;

class AbstractQuery {

    public function getActionName(): string {
        $class=explode('\\', get_class($this));
        return lcfirst(end($class));
    }

    public function buildQuery(): array {
        return array_filter(get_object_vars($this), fn($element)=>!empty($element));
    }

    public function httpPost(): object {
        $settings=Settings::get('telegram');
        $api_url='https://api.telegram.org/bot'.$settings['token'];
        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url.'/'.$this->getActionName());
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        if (isset($settings['proxy'])) {
            curl_setopt($ch, CURLOPT_PROXY, $settings['proxy']);
        }
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->buildQuery());
        $result=curl_exec($ch);
        curl_close($ch);
        if ($result===false) {
            throw new Exception('Не удалось поучить данные для '.$this->getActionName());
        }
        return json_decode($result);
    }

    public function httpGet(): object {
        $settings=Settings::get('telegram');
        $api_url='https://api.telegram.org/bot'.$settings['token'];
        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url.'/'.$this->getActionName().'?'.http_build_query($this->buildQuery()));
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        if (isset($settings['proxy'])) {
            curl_setopt($ch, CURLOPT_PROXY, $settings['proxy']);
        }
        $result=curl_exec($ch);
        curl_close($ch);
        if ($result===false) {
            throw new Exception('Не удалось поучить данные для '.$this->getActionName());
        }
        return json_decode($result);
    }

    public function webhookReplyJson(): void {
        $query=$this->buildQuery();
        $query['method']=$this->getActionName();
        header('Content-Type: application/json');
        echo json_encode($query, JSON_UNESCAPED_UNICODE);
    }

}
