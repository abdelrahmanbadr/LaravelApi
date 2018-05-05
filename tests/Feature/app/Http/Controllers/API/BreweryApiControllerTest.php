<?php

namespace Tests\Feature\app\Http\Controllers\API;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BreweryApiControllerTest extends TestCase
{
   /**
     * test getBeerBrewery
     *
     * @return void
     */
    public function test_get_breweries_beers_methods()
    {
        $this
        ->get(route('api.breweries.beers',['ids'=>'UbQHhM,5UddsE']))
        ->assertStatus(200);
        
    }
}
