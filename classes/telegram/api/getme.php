<?php

namespace Telegram\Api;

class GetMe implements actionInterface {

    public function buildQuery(): array {
        return [];
    }

    public function getActionName(): string {
        return 'getMe';
    }

}