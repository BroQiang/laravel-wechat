<?php
namespace App\Wechats\Activities;

use App\Models\Poster;
use App\Wechats\Activities\Posters\PostMessage;
use App\Wechats\Activities\Posters\SendPoster;
use Carbon\Carbon;
use EasyWeChat\Message\Text;

class Posters
{
    protected $message;
    protected $poster;

    public function __construct($message)
    {
        $this->message = $message;

        // 测试临时数据
        // $this->message = new \stdClass();
        // $this->message->EventKey     = 'activity_push_poster_1';
        // $this->message->FromUserName = 'op_5k0UcEzo87Czb65UWlLj2E6aA';
    }

    public function posterHandler()
    {

        if (!$this->checkEventKey()) {
            return null;
        }

        $keyArray = $this->formatKey($this->message->EventKey);

        if (!$this->getPosterByKey($keyArray[3])) {
            return null;
        }

        // 海报信息处理，获取到有效的海报信息，就发送海报
        if (!$this->posterProcess()) {
            return null;
        }

        // 如果是扫码关注,判断Key，处理扫码关注的逻辑
        if (isset($keyArray[4])) {
            (new PostMessage($this->poster, $this->message))->handler($keyArray[4]);
        }

        return null;
    }

    protected function checkEventKey()
    {
        $keyword = 'activity____push____poster';

        if ($this->message->Event == 'subscribe') {
            $keyword = 'qrscene_activity____push____poster';
        }

        $len = strlen($keyword);

        if (strncmp($keyword, substr($this->message->EventKey, 0, $len), $len) != 0) {
            \Illuminate\Support\Facades\Log::info('----------- Envent -- ' . $this->message->Event . ' -----------');
            \Illuminate\Support\Facades\Log::info('----------- Keyword -- ' . $keyword . ' -----------');
            \Illuminate\Support\Facades\Log::info('----------- EventKey -- ' . $this->message->EventKey . ' -----------');
            return false;
        }

        return true;
    }

    protected function formatKey($key)
    {
        // 处理key，最后一个字段是主键
        return explode('____', $key);
    }

    /**
     * 海报处理
     *
     * @param  [type] $key [description]
     *
     * @return [type] [description]
     */
    protected function posterProcess()
    {
        // 如果活动已经结束，发送活动结束的消息，并返回false
        if (Carbon::now()->gt(Carbon::parse($this->poster->end_time))) {
            $message = new Text(['content' => $this->poster->end_message]);
            app('wechat')->staff->message($message)->to($this->message->FromUserName)->send();
            return false;
        }

        // 全部通过了就开始处理海报生成及发送了
        (new SendPoster($this->poster, $this->message))->handler();

        return true;
    }

    protected function getPosterByKey($id)
    {

        if (is_numeric($id)) {
            $this->poster = Poster::find($id);
            return true;
        }
        return false;
    }
}
