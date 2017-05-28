<?php
namespace App\Wechats\Activities\Posters;

use App\Models\Poster;
use App\Models\PosterShareRecord;
use EasyWeChat\Message\Text;

class PostMessage
{

    protected $message;
    protected $poster;
    protected $shareUserOpenid;

    public function __construct(Poster $poster, $message = null)
    {
        $this->poster  = $poster;
        $this->message = $message;
    }

    public function handler($shareUserOpenid)
    {
        $this->shareUserOpenid = $shateUserOpenid;

        if ($this->shareUserOpenid == $this->message->FromUserName) {
            return null;
        }

        // 将助力信息记录
        $this->saveShareRecord();

        // 给分享用户发送消息
        $this->sendMesageToShareUser();

    }

    protected function saveShareRecord()
    {
        return PosterShareRecord::create([
            'poster_id'         => $this->poster->id,
            'share_user_openid' => $this->shareUserOpenid,
            'scan_user_openid'  => $this->message->FromUserName,
        ]);
    }

    protected function sendMesageToShareUser()
    {

        $shareQuantity = PosterShareRecord::where('share_user_openid', $this->shareUserOpenid)->count();

        switch ($shareQuantity <=> $this->poster->number) {
            case 0:
                $this->sendMessageToShareUser($this->poster->success_message);
                break;
            case -1:
                $this->sendHelpMessageToShareUser($this->poster->subscribe_message, $shareQuantity);
                break;
            case 1:
                $this->sendSuccessMessageToShareUser($this->poster->subscribe_message);
                break;

            default:
                # code...
                break;
        }

    }

    protected function sendSuccessMessageToShareUser()
    {
        if ($this->poster->is_send) {
            $this->sendMessageToShareUser($this->poster->success_message);
        }
    }

    protected function sendHelpMessageToShareUser($message, $shareQuantity)
    {
        $freeNumber = $this->poster->number - $shareQuantity;

        $message = str_replace('{!-nickname-!}', $this->message->FromUserName, $message);
        $message = str_replace('{!-quantity-!}', $freeNumber > 0 ? $freeNumber : 0, $message);

        $this->sendMessageToShareUser($message);
    }

    protected function sendMessageToShareUser($message)
    {
        $message = new Text(['content' => $message]);
        app('wechat')->staff->message($message)->to($this->shareUserOpenid)->send();
    }
}
