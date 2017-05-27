<?php
namespace App\Wechats;

use EasyWeChat\Message\Text;
use Illuminate\Support\Facades\Log;

class Messages
{

    private $text;

    public function __construct(Text $text)
    {
        $this->text = text;
    }

    public static function messageHandler($message)
    {
        
        if ($message->MsgType == 'text') {
            $text = new Text(['content' => '你好，测试信息']);
            Log::log($text->toArray());
            return $text;
        }
    }
}
