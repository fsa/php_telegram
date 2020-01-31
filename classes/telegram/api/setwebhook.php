<?php

namespace Telegram\Api;

class SetWebhook implements actionInterface {

    private $url;
    private $certificate;
    private $max_connections;
    private $allowed_updates=[];

    public function __construct(string $url, int $max_connections=null, array $allowed_updates=null, $certificate=null) {
        $this->setUrl($url);
        $this->setCertificate($certificate);
        $this->setMaxConnections($max_connections);
        $this->allowed_updates=$allowed_updates;
    }

    public function getActionName(): string {
        return 'setWebhook';
    }

    public function buildQuery(): array {
        $query=[];
        $query['url']=$this->url;
        if (!is_null($this->certificate)) {
            $query['certificate']=$this->certificate;
        }
        if (!is_null($this->max_connections)) {
            $query['max_connections']=$this->max_connections;
        }
        if (sizeof($this->allowed_updates)>0) {
            $query['allowed_updates']=$this->allowed_updates;
        }
        return $query;
    }

    public function setUrl(string $url) {
        $this->url=$url;
    }

    public function setCertificate($certificate) {
        $this->certificate=$certificate;
    }

    public function setMaxConnections(int $max_connections) {
        if ($max_connections<1 or $max_connections>100) {
            throw new \Exception('Max_connections - 1-100');
        }
        $this->max_connections=$max_connections;
    }

    public function setAllowedUpdates(array $allowed_updates) {
        $this->allowed_updates=$allowed_updates;
    }

    public function addAllowedUpdates(string $allowed_update) {
        $this->allowed_updates[]=$allowed_update;
    }

}
