<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\RandomBeerJob;
use App,Cache;
class BeerAPIController extends Controller
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
     * return random beers 
     * Api need to take [ name, abv, ibu, srmId, availabilityId, styleId] 
     * because we using non-Premium account
     * @return Json 
     */
    public function randomBeer()
    {
        $result = $this->breweryDb->sendRequest('beers', 'GET',[
             'ibu'=> rand(10,100),
             'hasLabels'=> "Y",
             'withBreweries'=> "Y",
             "randomCount"=>1,
             "order"=>"random",
        ]);
        $response = json_decode((string) $result->getBody());
        //if there is no describtion load another beer
        if(empty($response->data[0]->description)){
            return $this->randomBeer();
        }
        return response()->json($response->data[0]);
    }
    /**
     * function to cache random beer  
     */
    public function cacheRandomBeer()
    {
        Cache::forever('randomBeer',$this->randomBeer());
    }
    /**
     * function to cache random beer  
     */
    public function getRandomBeer()
    {

        if(Cache::Has('randomBeer')){
            $randomBeer = Cache::get('randomBeer');
        }else{
            $randomBeer = $this->randomBeer();
        }
        $this->dispatch(new RandomBeerJob());
        return $randomBeer;
    }
    /**
     * return breweries of specific beer 
     * take parameter beer Id 
     * @return Object 
     */
    public function getBeerBrewery($beerId)
    {
        // tomwG8 0SKDjZ 8PgW0r   
        $result = $this->breweryDb->sendRequest('/beer/'.$beerId.'/breweries', 'GET');
        $response = json_decode((string) $result->getBody());
        return $response->data;
    }
}
