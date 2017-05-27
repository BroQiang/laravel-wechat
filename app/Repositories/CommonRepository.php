<?php
namespace App\Repositories;

trait CommonRepository
{
    protected $except = ['_token'];

    public function setExcept($val)
    {
        $this->except = array_push($this->except, $val);

        return $this;
    }

    protected function arrayToObject($obj, $data)
    {
        foreach ($data as $key => $value) {
            if (!in_array($key, $this->except)) {
                $obj->$key = $value;
            }
        }

        return $obj;
    }
}
