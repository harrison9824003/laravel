<?php

use App\Models\DataType;
use App\Models\Article;
use App\Models\Category;
use App\Models\DataTypeFolder;
use App\Models\Shop\Product;
use App\Models\Shop\SpecCategory;
use App\Models\Shop\ProductImage;

return [
    Article::class => [
        'id' => 1,
        'route' => 'article',
        'icon' => 'bx-pencil',
        'name' => '文章'
    ],
    Product::class => [
        'id' => 2,
        'route' => 'product',
        'icon' => 'bxl-product-hunt',
        'name' => '商品'
    ],
    SpecCategory::class => [
        'id' => 3,
        'route' => 'spec',
        'icon' => 'bx-category',
        'name' => '規格分類'
    ],
    DataType::class => [
        'id' => 4,
        'route' => 'datatype',
        'icon' => 'bx-briefcase',
        'name' => '模組'
    ],
    Category::class => [
        'id' => 5,
        'route' => 'category',
        'icon' => 'bx-category',
        'name' => '全站分類'
    ],
    DataTypeFolder::class => [
        'id' => 6,
        'route' => 'datatypefolder',
        'icon' => 'bx-folder',
        'name' => '模組分類'
    ],
    ProductImage::class => [
        'id' => 7,
        'route' => 'productimg',
        'icon' => 'bx-image-alt',
        'name' => '商品圖片'
    ]
];