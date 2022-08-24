<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Shop\Entity\Merchandise;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Schema::disableForeignKeyConstraints();

        Merchandise::truncate();
        Merchandise::factory(100)->create();

        Schema::enableForeignKeyConstraints();
    }
}
