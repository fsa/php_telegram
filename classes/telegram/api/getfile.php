<?php

namespace Telegram\Api;

class GetFile implements actionInterface {
    private $file_id;

    public function __construct(string $file_id=null) {
        if(!is_null($file_id)) {
            $this->file_id=$file_id;
        }
    }

    public function buildQuery(): array {
        if (is_null($this->file_id)) {
            throw new Exception('Required: file_id');
        }
        return $query=["file_id"=>$this->file_id];
    }

    public function getActionName(): string {
        return 'getFile';
    }

}
