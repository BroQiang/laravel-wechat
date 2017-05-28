<?php
namespace App\Wechats\Activities\Posters;

use App\Models\Poster;
use App\Wechats\Activities\Posters\PosterImage;
use EasyWeChat\Message\Image;
use EasyWeChat\Message\Text;

class SendPoster
{
    private $message;
    private $poster;

    public function __construct(Poster $poster, $message)
    {
        $this->message = $message;
        $this->poster  = $poster;
    }

    public function handler()
    {
        // 获取海报图片并发送
        $this->sendImage();
        // 发送海报需要发送的消息
        $message = new Text(['content' => $this->poster->get_message]);
        $this->sendStaffToWechat($message);
    }

    protected function sendImage()
    {
        // 获取海报图片的 media_id
        if($mediaId = (new PosterImage($this->poster, $this->message))->getMediaId()) {
            // 发送海报图片
            $message = new Image(['media_id' => $mediaId]);
            $this->sendStaffToWechat($message);
        }

        return null;
    }

    protected function sendStaffToWechat($message)
    {
        app('wechat')->staff->message($message)->to($this->message->FromUserName)->send();
    }
}
