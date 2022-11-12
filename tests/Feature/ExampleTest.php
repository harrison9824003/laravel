<?php

namespace Tests\Feature;

use Illuminate\Database\Events\DatabaseRefreshed;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use DatabaseRefreshed;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
