<?php

/**
 * Telegram Bot API 4.6
 */

namespace Telegram\Api;

class GetWebhookInfo implements actionInterface {

    public function buildQuery(): array {
        return [];
    }

    public function getActionName(): string {
        return 'getWebhookInfo';
    }

}
