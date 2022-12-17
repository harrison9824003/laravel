<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\DataType;
use App\Models\Shop\Product;
use App\Models\Shop\SpecCategory;
use Illuminate\Console\Command;

class initWebSite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:website';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'init website datatype';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $models = collect(config('model'));
        $models->each(function($item, $key){
            DataType::create([
                'id' => $item['id'],
                'name' => $item['name'],
                'class_name' => $key,
                'disabled' => 0,
                'icon' => !empty($item['icon']) ? $item['icon'] : 'bx-note',
                'folder_id' => 0,
                'router_path' => 'adm/' . $item['route']
            ]);
        });
        // 商品類別初始
        $productCategoryId = config('product.category.id');
        $productSubCategory = config('product.sub_category');
        Category::factory()->create([
            'id' => $productCategoryId,
            'name' => config('product.category.name'),
        ]);
        foreach($productSubCategory as $item){
            Category::factory()->create([
                'parent_id' => $productCategoryId,
                'id' => $item['id'],
                'name' => $item['name'],
            ]);
        }

        // 隨機全站類別
        $category = Category::factory(5)->create();
        $category->each(function($item, $key){
            Category::factory()->create([
                'parent_id' => $item->id,
            ]);
        });

        // 隨機全站規格
        SpecCategory::factory(10)->create();

        Product::factory(10)->create();
        print("init done.\n");
        return 0;
    }
}
