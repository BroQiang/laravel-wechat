<?php
namespace App\Wechats;

class Messages
{

    public static function messageHandler($message)
    {
        $tempMessage = '谢谢你的留言，我还太小，没学会回复呢……';

        switch ($message->MsgType) {
            case 'event':
                return (new Event($message))->eventHandler();
                break;
            case 'text':
                return $tempMessage;
                break;
            case 'image':
                return $tempMessage;
                break;
            case 'voice':
                return $tempMessage;
                break;
            case 'video':
                return $tempMessage;
                break;
            case 'location':
                return $tempMessage;
                break;
            case 'link':
                return null;
                break;
            // ... 其它消息
            default:
                return null;
                break;
        }
    }
}
