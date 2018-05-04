<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
class SearchApiController extends Controller
{
    /**
     * Object of BreweryDb Service.
     *
     * @var Object
     */
    private $breweryDb;
    public function __construct()
    {
        $this->breweryDb = App::make('brewerydb');
    }
     /**
     * return beers by the brewery associated with that beer
     * take parameters search query and search type
     * @return Json 
     */
    public function search($searchQuery,$type) 
    {

        $result = $this->breweryDb->sendRequest('/search', 'GET',[
            'searchQuery'=>$q,
            'type'=>$type,
       ]);
        $response = json_decode((string) $result->getBody());
        return response()->json($response->data);
    }
}
