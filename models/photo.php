<?php

namespace Model;

class Photo extends ActiveRecord
{
    protected static $tabla = 'photos';
    protected static $columnasDB = ['id', 'url', 'label', 'userId'];

    public $id;
    public $url;
    public $label;
    public $userId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->url = $args['url'] ?? '';
        $this->label = $args['label'] ?? '';
        $this->userId = $args['userId'] ?? '';
    }
}
