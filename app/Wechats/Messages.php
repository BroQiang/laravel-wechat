<?php
namespace App\Wechats;

use EasyWeChat\Message\Text;

class Messages
{

    private $text;

    public function __construct(Text $text)
    {
        $this->text = text;
    }

    public function messageHandler($message)
    {
        if ($message->MsgType == 'text') {
            $text = new Text(['content' => '你好，测试信息']);
        }
    }
}
