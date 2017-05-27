<?php
namespace App\Uploads;

use Illuminate\Http\Request;

class Uploads
{

    protected $savePath = 'uploads';

    protected $saveName;

    protected $uploadFile = 'photo';

    protected $extensions = ['png', 'jpg'];

    protected $maxSize = 2000000;

    public function __construct($uploadFile = null, $savePath = null, $saveName = null)
    {
        $this->setUploadFile($uploadFile);
        $this->setSavePath($savePath);
        $this->setSaveName($saveName);
    }

    public function setMaxSize($maxSize)
    {
        if ($maxSize) {
            $this->maxSize = $maxSize;
        }

        return $this;
    }

    public function setSavePath($savePath)
    {
        if ($savePath) {
            $this->savePath = $savePath;
        }

        return $this;
    }

    public function setUploadFile($name)
    {
        if ($name) {
            $this->uploadFile = $name;
        }

        return $this;
    }

    public function setSaveName($saveName)
    {
        if ($saveName) {
            $this->saveName = $saveName;
        }

        return $this;
    }

    public function upload(Request $request)
    {
        $this->checkUpload($request);

        return $this->saveUpload($request);
    }

    protected function saveUpload(Request $request)
    {
        if ($this->saveName) {
            return $request->file($this->uploadFile)
                ->storeAs($this->savePath, $this->saveName . '.' . $request->file($this->uploadFile)->getClientOriginalExtension());
        }

        return $request->file($this->uploadFile)->store($this->savePath);
    }

    protected function checkUpload(Request $request)
    {
        // 确认文件是否存在
        $this->hasFile($request);
        // 验证上传文件是否有效
        $this->isValid($request);
        // 验证后缀名
        $this->isExtension($request);
        // 验证图片是否超过指定的尺寸
        $this->isMaxSize($request);

    }

    protected function hasFile(Request $request)
    {
        if (!$request->hasFile($this->uploadFile)) {
            throw new UploadsException("上传的文件{$this->uploadFile}不存在");
        }
    }

    protected function isValid(Request $request)
    {
        if (!$request->file($this->uploadFile)->isValid()) {
            throw new UploadsException("上传的文件{$this->uploadFile}不是有效文件");
        }
    }

    protected function isExtension(Request $request)
    {
        if (!in_array($request->file($this->uploadFile)->getClientOriginalExtension(),
            $this->extensions
        )) {
            throw new UploadsException("不支持的文件类型，只支持 <code>" . implode('，', $this->extensions) . "</code> 格式");
        }
    }

    protected function isMaxSize(Request $request)
    {
        $size = $request->file($this->uploadFile)->getSize();
        if ($size > $this->maxSize) {
            throw new UploadsException("
                上传图片是：<code>" . round($size / 1024) . " k</code>，最大只允许<code>" . round($this->maxSize / 1024) . " k</code>的图片");
        }
    }

}
