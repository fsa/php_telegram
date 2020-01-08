<?php

namespace Telegram\Api;

interface actionInterface {

    function getActionName(): string;

    function buildQuery(): array;
}
