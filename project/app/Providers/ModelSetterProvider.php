<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\DataType;
use App\Models\Article;
use App\Models\Categroy;
use App\Models\DataTypeFolder;
use App\Models\Shop\Product;
use App\Models\Shop\SpecCategory;

class ModelSetterProvider extends ServiceProvider
{
    const ModelIds = [
        Article::class => '1',
        Product::class => '2',
        SpecCategory::class => 3,
        DataType::class => 4,
        Categroy::class => 5,
        DataTypeFolder::class => 6,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // 文章管理
        $this->app->singleton(Article::class, function($app) {
            $article = new Article();
            $article->set_model_id(self::ModelIds[Article::class]);
            return $article;
        });

        // 商品管理
        $this->app->singleton(Product::class, function($app) {
            $product = new Product();
            $product->set_model_id(self::ModelIds[Product::class]);
            return $product;
        });

        // 規格管理
        $this->app->singleton(SpecCategory::class, function($app) {
            $spec_category = new SpecCategory();
            $spec_category->set_model_id(self::ModelIds[SpecCategory::class]);
            return $spec_category;
        });

        // 後台 Model 管理
        $this->app->singleton(DataType::class, function($app) {
            $datatype = new DataType();
            $datatype->set_model_id(self::ModelIds[DataType::class]);
            return $datatype;
        });

        // 後台 Model folder 管理
        $this->app->singleton(DataTypeFolder::class, function($app) {
            $datatypefolder = new DataTypeFolder();
            $datatypefolder->set_model_id(self::ModelIds[DataTypeFolder::class]);
            return $datatypefolder;
        });

        // 全站分類管理
        $this->app->singleton(Categroy::class, function($app) {
            $category = new Categroy();
            $category->set_model_id(self::ModelIds[Categroy::class]);
            return $category;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $checks = DataType::pluck('id')->toArray();
        
        //  檢查綁定的 model 是否有建立 model id 到資料庫
        foreach( self::ModelIds as $model_name => $model_id ) {            
                        
            if ( !in_array($model_id, $checks) ) {
                $datetype = DataType::create([
                    'id' => $model_id,
                    'name' => $model_name,
                    'class_name' => $model_name,
                    'disabled' => 0,
                    'icon' => 'bx-note'
                ]);
                //$datetype->save();                
            }
            
        }
    }
}
