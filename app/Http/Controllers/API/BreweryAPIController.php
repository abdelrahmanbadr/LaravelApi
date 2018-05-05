<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
    public function getBreweriesBeers($ids) //DX8ad2
    {
        $ids = explode(',',$ids); 
        $data = [];
        foreach($ids as $id){
            $result = $this->breweryDb->sendRequest('/brewery/'.$id.'/beers', 'GET');
            $response = json_decode((string) $result->getBody());
            if(!empty($response->data))
                $data=array_merge($data,$response->data);

        }
        return response()->json($data);
    }
}
