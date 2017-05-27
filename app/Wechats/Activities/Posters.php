<?php
namespace App\Wechats\Activities;

use App\Models\Poster;
use App\Wechats\Users;

class Posters
{
    public $message;

    public function __construct($message = null)
    {
        // $this->message = $message;
        $this->message = new \stdClass();

        $this->message->EventKey     = 'activity_push_poster_1';
        $this->message->FromUserName = 'op_5k0UcEzo87Czb65UWlLj2E6aA';
    }

    public function posterHandler()
    {
        // 获取海报信息
        if (!$poster = $this->getPosterByKey($this->message->EventKey)) {
            return null;
        }

        // 获取用户信息
        dd(app('wechat')->user->get($this->message->FromUserName));

        return $poster;
    }

    protected function getPosterByKey($key)
    {
        // 处理key，最后一个字段是主键
        $tempArray = explode('_', $key);

        if (is_numeric($id = end($tempArray))) {
            return Poster::find($id);
        }
    }
}
