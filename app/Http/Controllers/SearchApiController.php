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
     * take parameters search query and search type
     * @return Json 
     */
    public function search($searchQuery,$searchType) 
    {
        if($this->isValidateSearchQuery == false ){
            return response()->json(["error"=>"Search Query Is Not Valid"]);
        }

        $result = $this->breweryDb->sendRequest('/search', 'GET',[
            'q'=>$searchQuery,
            'type'=>$searchType,
       ]);
        $response = json_decode((string) $result->getBody());
        if(!empty($response->data))
            return response()->json($response->data);
        else
            return response()->json(["error"=>"No Beers Exists"]);
    }

    public function isValidateSearchQuery($searchQuery) 
    {
        return !preg_match('/[^A-Za-z0-9\\- ]/', $searchQuery);  
    }
}
