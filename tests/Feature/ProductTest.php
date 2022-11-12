<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Models\User;

class ProductTest extends TestCase
{
    //use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetProductAdmin()
    {
        $user = User::findOrFail(5);
        $response = $this->actingAs($user)->withHeaders([
            'X-Header' => 'Value'
        ])->get('/adm/product/index');

        $response->assertStatus(200);
    }

    public function testGetMenu()
    {
        $response = $this->getJson('api/menu');

        $response->assertStatus(200)->assertJsonStructure(['data']);
    }
}
