<?php

namespace Tests\Feature\app\Http\Controllers\API;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BeerApiControllerTest extends TestCase
{
     /**
     * test getRandomBeer
     *
     * @return void
     */
    public function test_get_random_beer_method()
    {
        $this
        ->get(route('api.beers.random'))
        ->assertStatus(200);
        
    }
}
