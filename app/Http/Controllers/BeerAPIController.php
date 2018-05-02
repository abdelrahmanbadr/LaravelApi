<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
class BeerAPIController extends Controller
{
    private $breweryDb;
    public function __construct()
    {
        $this->breweryDb = App::make('brewerydb');
    }

    public function randomBeers()
    {
        $result = $this->breweryDb->sendRequest('beers', 'GET',[
             'ibu'=> rand(10,100),
        ]);
        $response = json_decode((string) $result->getBody());
        return $response->data;
    }

    public function getBeerBrewery($beerId)
    {
        // tomwG8 0SKDjZ 8PgW0r   
        $result = $this->breweryDb->sendRequest('/beer/'.$beerId.'/breweries', 'GET');
        $response = json_decode((string) $result->getBody());
        return $response->data;
    }
}
