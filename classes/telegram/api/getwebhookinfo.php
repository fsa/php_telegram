<?php

/**
 * Telegram Bot API 5.0
 */

namespace Telegram\Api;

class GetWebhookInfo extends AbstractQuery {

    public function httpGet(): \Telegram\Entity\WebhookInfo {
        $result=parent::httpGet();
        if(isset($result->ok) and $result->ok===true) {
            return new \Telegram\Entity\WebhookInfo(get_object_vars($result->result));
        } else {
            return null;
        }
    }

}
