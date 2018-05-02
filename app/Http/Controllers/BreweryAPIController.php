<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facades\App\Http\Controllers\BeerAPIController as Beer;
use App;
class BreweryAPIController extends Controller
{
    private $breweryDb;

    public function __construct()
    {
        $this->breweryDb = App::make('brewerydb');
    }

    public function getBreweryBeers($beerId="DX8ad2")
    {
        // $brewery = $this->getBeerBrewery($beerId);
        $brewery = Beer::getBeerBrewery($beerId);
        $result = $this->breweryDb->sendRequest('/brewery/'.$brewery[0]->id.'/beers', 'GET');
        $response = json_decode((string) $result->getBody());
        return $response->data;
    }
}
