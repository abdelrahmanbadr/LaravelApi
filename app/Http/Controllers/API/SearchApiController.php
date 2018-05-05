<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
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
    private $validSearchTypes = ['beer','brewery'];
    private $unprocessableStatusCode = 422;
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
        // dd($searchQuery);
        if(!in_array($searchType,$this->validSearchTypes)){
            return response()->json(["error"=>"Search Type Is Not Valid"],$this->unprocessableStatusCode);
        }
        
        if($this->isValidateSearchQuery($searchQuery) == false ){
            return response()->json(["error"=>"Search Query Is Not Valid"],$this->unprocessableStatusCode);
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

    /**
     * if valid query will return true else return false
     * @return Boolean 
     */
    public function isValidateSearchQuery($searchQuery) 
    {
        return !preg_match('/[^A-Za-z0-9\\- ]/', $searchQuery);  
    }
}
