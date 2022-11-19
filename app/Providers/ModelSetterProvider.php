<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\DataType;
use App\Models\Article;
use App\Models\Categroy;
use App\Models\DataTypeFolder;
use App\Models\Shop\Product;
use App\Models\Shop\SpecCategory;
use App\Models\Shop\ProductImage;

class ModelSetterProvider extends ServiceProvider
{
    private const MODELIDS = [
        Article::class => 1,
        Product::class => 2,
        SpecCategory::class => 3,
        DataType::class => 4,
        Categroy::class => 5,
        DataTypeFolder::class => 6,
        ProductImage::class => 7,
    ];

    private const MODELROUTE = [
        Article::class => 'article',
        Product::class => 'product',
        SpecCategory::class => 'spec',
        DataType::class => 'datatype',
        Categroy::class => 'category',
        DataTypeFolder::class => 'datatypefolder',
        ProductImage::class => 'productimg',
    ];

    private const MODELICON = [
        Article::class => 'bx-pencil',
        Product::class => 'bxl-product-hunt',
        SpecCategory::class => 'bx-category',
        DataType::class => 'bx-briefcase',
        Categroy::class => 'bx-category',
        DataTypeFolder::class => 'bx-folder',
        ProductImage::class => 'bx-image-alt',
    ];

    private const MODELNAME = [
        Article::class => '文章',
        Product::class => '商品',
        SpecCategory::class => '規格分類',
        DataType::class => '模組',
        Categroy::class => '全站分類',
        DataTypeFolder::class => '模組分類',
        ProductImage::class => '商品圖片',
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // 文章管理
        $this->app->singleton(Article::class, function ($app) {
            $article = new Article();
            $article->setModelId(self::MODELIDS[Article::class]);
            return $article;
        });

        // 商品管理
        $this->app->singleton(Product::class, function ($app) {
            $product = new Product();
            $product->setModelId(self::MODELIDS[Product::class]);
            return $product;
        });

        // 規格管理
        $this->app->singleton(SpecCategory::class, function ($app) {
            $spec_category = new SpecCategory();
            $spec_category->setModelId(self::MODELIDS[SpecCategory::class]);
            return $spec_category;
        });

        // 後台 Model 管理
        $this->app->singleton(DataType::class, function ($app) {
            $datatype = new DataType();
            $datatype->setModelId(self::MODELIDS[DataType::class]);
            return $datatype;
        });

        // 後台 Model folder 管理
        $this->app->singleton(DataTypeFolder::class, function ($app) {
            $datatypefolder = new DataTypeFolder();
            $datatypefolder->setModelId(self::MODELIDS[DataTypeFolder::class]);
            return $datatypefolder;
        });

        // 全站分類管理
        $this->app->singleton(Categroy::class, function ($app) {
            $category = new Categroy();
            $category->setModelId(self::MODELIDS[Categroy::class]);
            return $category;
        });

        // 圖片
        $this->app->singleton(ProductImage::class, function ($app) {
            $productimg = new ProductImage();
            $productimg->setModelId(self::MODELIDS[ProductImage::class]);
            return $productimg;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if(!DataType::all()->count()){
            $checks = DataType::pluck('id')->toArray();

            //  檢查綁定的 model 是否有建立 model id 到資料庫
            foreach (self::MODELIDS as $model_name => $model_id) {
                if (!in_array($model_id, $checks)) {
                    $datetype = DataType::create([
                        'id' => $model_id,
                        'name' => self::MODELNAME[$model_name],
                        'class_name' => $model_name,
                        'disabled' => 0,
                        'icon' => isset(self::MODELICON[$model_name]) ? self::MODELICON[$model_name] : 'bx-note',
                        'folder_id' => 0,
                        'router_path' => 'adm/'. self::MODELROUTE[$model_name]
                    ]);
                    //$datetype->save();
                }
            }
        }
        
    }
}
