<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class FrontTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('api/front/5');
        $response->dump();
        $response->assertJson(fn (AssertableJson $json) => 
            $json->where('data.title', '1235')
            ->where('data.category', '食品')
            ->etc()
        );
    }
}
