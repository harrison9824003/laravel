<?php 
    namespace App\Traits;

    /**
     * 設定 model id, 提供給共用圖片資料分辨屬於哪一個 model 下的資料
     */
    trait HasFrontData {        

        /**
         * 回傳前台統一格式
         * 
         * category: 網站總分類
         * title: 資料標題
         * sub_title: 資料副標題
         * create: 建立時間
         * update: 建立時間
         * create_person: 建立人員
         * update_person: 修改人員
         * content: 主內容
         * simple_content: 簡介內容
         * other: 其他內容 e.g. 商品的規格、分類等, 由頁面本身撈取
         */
        public function get_front_data() {

            return $this->toArray();
        }

    }
?>