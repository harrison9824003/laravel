<?php

namespace Tests\Feature;

use Illuminate\Database\Events\DatabaseRefreshed;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class FrontTest extends TestCase
{
    use DatabaseRefreshed;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('api/front/5');
        $response->dump();
        $response->assertJson(fn (AssertableJson $json) =>
        $json->where('data.title', '1235')
            ->where('data.category', '食品')
            ->etc());
    }
}
