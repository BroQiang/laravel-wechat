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
        $this->shareUserOpenid = $shareUserOpenid;

        if ($this->shareUserOpenid == $this->message->FromUserName) {
            return null;
        }

        // 判断用户是否助理过，如果助力过了，就不再做处理，一个人只能助力几次，这个次数要后台设置
        if ($this->checkAlreadyHelp()) {
            // 将助力信息记录
            $this->saveShareRecord();
            // 给分享用户发送消息
            $this->sendMesageToShareUser();

            return null;
        }

        // 发送已经助力过的消息
        $this->sendAlreadyHelpMessageToFromUser();

    }

    protected function sendAlreadyHelpMessageToFromUser()
    {
        $message = new Text(['content' => $this->poster->already_help_message]);
        app('wechat')->staff->message($message)->to($this->message->FromUserName)->send();
    }

    protected function checkAlreadyHelp()
    {
        $times = PosterShareRecord::where('poster_id', $this->poster->id)
            // ->where('share_user_openid', $this->shareUserOpenid)
            ->where('scan_user_openid', $this->message->FromUserName)
            ->count();
        // 查询出当前用户助力过的次数，如果没有助力过，返回true
        if ($times == 0) {
            return true;
        }

        // 判断用户助力次数是否小于允许的最大次数
        if ($times < $this->poster->allow_times) {
            return true;
        }

        return false;
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

        $shareQuantity = PosterShareRecord::where('share_user_openid', $this->shareUserOpenid)->
            where('poster_id', $this->poster->id)->count();

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

        $toUserNickName = app('wechat')->user->get($this->message->FromUserName)->nickname;

        $message = str_replace('{!-nickname-!}', $toUserNickName, $message);
        $message = str_replace('{!-quantity-!}', $freeNumber > 0 ? $freeNumber : 0, $message);

        $this->sendMessageToShareUser($message);
    }

    protected function sendMessageToShareUser($message)
    {
        $message = new Text(['content' => $message]);
        app('wechat')->staff->message($message)->to($this->shareUserOpenid)->send();
    }
}
