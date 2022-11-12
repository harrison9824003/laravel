<?php

namespace App\Traits;

/**
 * 設定 model id, 提供給共用圖片資料分辨屬於哪一個 model 下的資料
 */
trait HasModelId
{
    protected $model_id = 0; // 全站唯一值

    public function getModelId()
    {
        return $this->model_id;
    }

    public function setModelId($model_id)
    {
        $this->model_id = $model_id;
    }
}
