<?php
namespace App\Wechats\Activities;

class Posters
{
    private $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function posterHandler()
    {
        if (!$poster = $this->getPosterByKey($this->message->EventKey)) {
            return null;
        }
    }

    protected function getPosterByKey($key)
    {
        // 处理key，最后一个字段是主键
        $id = end(explode('_', $key));

        return $id;
    }
}
