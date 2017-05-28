<?php
namespace App\Wechats\Activities\Posters;

use App\Models\Poster;
use App\Models\PosterMedias;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PosterImage
{
    protected $message;
    protected $poster;

    public function __construct(Poster $poster, $message = null)
    {
        $this->message = $message;
        $this->poster  = $poster;
    }

    public function getMediaId()
    {
        // 判断是否缓存了，如果缓存了，就直接返回
        if ($posterMedias = PosterMedias::where('poster_id', $this->poster->id)
            ->where('openid', $this->message->FromUserName)
            ->first()
        ) {
            return $posterMedias->media_id;
        }

        // 如果没返回，就去生成
        return $this->generateMedia();
    }

    protected function generateMedia()
    {

        if ($this->checkFirstFile()) {
            return null;
        }

        // 服务器1G的，没敢装redis，凑合用文件缓存吧
        $this->writeFirstFile();

        // 上传素材到微信
        $media = app('wechat')->material->uploadImage($this->mergeImages());
        // 将素材信息缓存到数据库
        PosterMedias::create([
            'poster_id' => $this->poster->id,
            'openid'    => $this->message->FromUserName,
            'media_id'  => $media->media_id,
            'url'       => $media->url,
        ]);

        return $media->media_id;
    }

    protected function writeFirstFile()
    {
        Storage::put(storage_path('temp' . $this->poster->id . '_' . $this->message->FromUserName), time());
    }

    protected function checkFirstFile()
    {
        return Storage::get(storage_path('temp' . $this->poster->id . '_' . $this->message->FromUserName));
    }

    protected function mergeImages()
    {
        // 获取微信用户信息
        $this->setUser();
        // 获取海报原图
        $img = Image::make(storage_path('app/' . $this->poster->img_url));

        // 将头像插入
        $img->insert($this->avatarImg(), 'top-left', $this->poster->avatar_width, $this->poster->avatar_height);
        // 将昵称插入
        $img->insert($this->nicknameImg(), 'top-left', $this->poster->nickname_width, $this->poster->nickname_height);
        // 插入二维码
        $img->insert($this->qecodeImg(), 'top-left', $this->poster->qrcode_width, $this->poster->qrcode_height);

        $savePath = storage_path('app/' . $this->poster->img_url . '_' . $this->user->openid . '.jpg');
        $img->save($savePath);

        return $savePath;
    }

    protected function qecodeImg()
    {
        $qrcode = app('wechat')->qrcode;
        // 创建二维码
        $sceneValue = 'activity____push____poster____' . $this->poster->id . '____' . $this->message->FromUserName;

        $qrcodeImgUrl = $qrcode->url($qrcode->forever($sceneValue)->ticket);

        return Image::make($qrcodeImgUrl)->resize($this->poster->qrcode_size, $this->poster->qrcode_size);
    }

    protected function nicknameImg()
    {
        // 后面需要动态取值的有,长度，字体颜色，背景色

        $str = $this->user->nickname;

        $len = strlen($str);

        // 因为PHP有bug，imagettftext不支持中文,都当日文去处理，很恶心，转成html-entities去处理了
        $str = mb_convert_encoding($str, "html-entities", "utf-8");

        // 创建一个昵称生成的图片
        $img = Image::canvas($this->poster->nickname_font_width + 10,
            $this->poster->nickname_font_height, $this->poster->nickname_backgroup_color);
        $img->text($str, 10, $this->poster->nickname_font_top, function ($font) {
            $font->file(storage_path('fonts/simhei.ttf'));
            $font->size($this->poster->nickname_font_size);
            $font->color($this->poster->nickname_color);
            $font->align('left');
            $font->valign('top');
        });
        return $img;
    }

    protected function avatarImg()
    {
        // 最后生成的时候要根据后台设置的头像尺寸去设置
        return Image::make($this->user->headimgurl)->resize($this->poster->avatar_size, $this->poster->avatar_size);
    }

    protected function setUser()
    {
        $this->user = app('wechat')->user->get($this->message->FromUserName);
    }

}
