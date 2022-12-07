<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\DataType;
use App\Models\Article;
use App\Models\Category;
use App\Models\DataTypeFolder;
use App\Models\Shop\Product;
use App\Models\Shop\SpecCategory;
use App\Models\Shop\ProductImage;
use Illuminate\Support\Facades\Schema;

class ModelSetterProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $models = collect(config('model'));

        $models->each(function($item, $key){
            $this->app->singleton($key, function () use ($item, $key) {
                $object = new $key();
                $object->setModelId($item['id']);
                return $object;
            });
        });
    }
}
