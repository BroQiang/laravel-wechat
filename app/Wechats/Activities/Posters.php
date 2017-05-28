<?php
namespace App\Wechats\Activities;

use App\Models\Poster;
use App\Wechats\Activities\Posters\SendPoster;
use Carbon\Carbon;
use EasyWeChat\Message\Text;

class Posters
{
    public $message;
    private $poster;

    public function __construct($message = null)
    {
        // $this->message = $message;
        $this->message = new \stdClass();

        $this->message->EventKey     = 'activity_push_poster_1';
        $this->message->FromUserName = 'op_5k0UcEzo87Czb65UWlLj2E6aA';
    }

    public function posterHandler()
    {
        // 海报信息处理，获取到有效的海报信息，就发送海报
        if (!$this->posterProcess($this->message->EventKey)) {
            return null;
        }

        // --------------------------------------------
        return null;

        return $poster;
    }

    /**
     * 海报处理
     *
     * @param  [type] $key [description]
     *
     * @return [type] [description]
     */
    protected function posterProcess($key)
    {
        if (!$this->getPosterByKey($key)) {
            return false;
        }
        // 如果活动已经结束，发送活动结束的消息，并返回false
        if (Carbon::now()->gt(Carbon::parse($this->poster->end_time))) {
            $message = new Text(['content' => $this->poster->end_message]);
            app('wechat')->staff->message($message)->to($this->message->FromUserName)->send();
            return false;
        }

        // 全部通过了就开始处理海报生成及发送了
        (new SendPoster($this->poster,$this->message))->handler();

        return true;
    }

    protected function getPosterByKey($key)
    {
        // 处理key，最后一个字段是主键
        $tempArray = explode('_', $key);

        if (is_numeric($id = end($tempArray))) {
            $this->poster = Poster::find($id);
            return true;
        }
        return false;
    }
}
