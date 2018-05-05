<?php

namespace Tests\Feature\app\Http\Controllers\API;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchApiControllerTest extends TestCase
{
    /**
     * test Search Query
     *
     * @return void
     */
    public function test_search_method_returns_not_valid_searchQuery()
    {
        $serachQuery = "brewery.*";
        $type = "beer";
        $this
        ->get(route('api.brewerydb.search',['q'=>$serachQuery,'type'=>$type]))
        ->assertJson( ["Search Query Is Not Valid"]);
    }
    /**
     * test Search Type
     *
     * @return void
     */
    public function test_search_method_returns_not_valid_searchType()
    {
        $serachQuery = "hock";
        $type = "beera";
        $this
        ->get(route('api.brewerydb.search',['q'=>$serachQuery,'type'=>$type]))
        ->assertStatus(422)
        ->assertJson(
            ["Search Type Is Not Valid"]
        );
    }
    /**
     * test Search function status
     *
     * @return void
     */
    public function test_search_method_returns_no_data()
    {
        $serachQuery = "serach Query";
        $type = "beer";
        $this
        ->get(route('api.brewerydb.search',['q'=>$serachQuery,'type'=>$type]))
        ->assertStatus(200)
        ->assertJson([
            'empty' => "No Beers Exists",
        ]);
    }
}
