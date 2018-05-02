<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facades\App\Http\Controllers\BeerAPIController as Beer;
use App;
class BreweryAPIController extends Controller
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
     * take parameter beer Id 
     * @return Json 
     */
    public function getBreweryBeers($beerId) //DX8ad2
    {
        // need to be refactored and merge all breweries beers not first one only
        $brewery = Beer::getBeerBrewery($beerId);
        $result = $this->breweryDb->sendRequest('/brewery/'.$brewery[0]->id.'/beers', 'GET');
        $response = json_decode((string) $result->getBody());
        return response()->json($response->data);
    }
}
