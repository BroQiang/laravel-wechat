<?php
namespace App\Wechats\Activities;

use App\Models\Poster;

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

        return $poster->name;
    }

    protected function getPosterByKey($key)
    {

        return $key;
        // 处理key，最后一个字段是主键
        $tempArray = explode('_', $key);

        if (is_numeric($id = end($tempArray))) {
            return Poster::find($id);
        }

        return false;
    }
}
