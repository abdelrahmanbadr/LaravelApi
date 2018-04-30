<?php

namespace App\Services;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Cache;

class BreweryDb 
{
    
    private  $client;
    private  $header;
    private  $api_url;
    private  $api_key;
    private  $params;

    public function __construct()
    {
        $this->api_url = "http://api.brewerydb.com/v2/";
        $this->api_key = env('BREWERYDB_API_KEY');
        $this->client = new Client();
       // $this->header = [ 'Authorization' => 'Bearer '.Cache::get('access_token') ];
    }

    public function getParameters() 
    {
        return array_merge(['key' => $this->api_key], $this->params);
    }

    public function setParameters($params) 
    {
        $this->params = $params;
    }
    
    public function sendRequest($endpoint,$method = 'GET',$params = []) 
    {
        
        $this->setParameters($params);
        
       //dd($this->api_url.$endpoint);
        return  $this->client->request($method, $this->api_url.$endpoint, [
            'query' => $this->getParameters()
        ]);
        
        
    }

}
