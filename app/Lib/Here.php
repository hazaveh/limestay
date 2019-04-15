<?php

namespace App\Lib;

use GuzzleHttp\Client;

class Here {
    
    protected $endpoint = 'https://places.api.here.com';
    protected $body;
    protected $client;

    public function __construct()
    {

        if (!env('HERE_APPID') || !env('HERE_APPCODE')) {
            throw new \Exception("Here.com API credentials are missing.");
        }

        $this->body = [
            'cat' => 'accommodation',
            "app_id" => env('HERE_APPID'), 
            "app_code" => env('HERE_APPCODE'),
            "size" => 15,
            "tf" =>"plain"
        ];

        $this->client = new Client([
            // Base URI is used with relative requests
            'base_uri' => $this->endpoint,
            'timeout'  => 4.0,
        ]);

    }

    /**
     * Lookup for all accommodations available near a location
     *
     * @param string $location
     * @param boolean $is_coordinates
     * @return collection
     */
    public function nearby($location, $is_coordinate = true) 
    {        
             
        try {
            $response = $this->client->request('GET', 'places/v1/discover/explore', [
                    'query' => array_merge($this->body, ['at' => $location]),
            ]);

        } catch (\Exception $e) {
            throw new \Exception("Connection To API Server Failed.");
        }
            
        $result = collect(json_decode($response->getBody()->getContents(), true)['results']['items']);
                
        return $result;
    }

    public function getPlace($href) {
        try {
            $address = json_decode(file_get_contents($href), true);
            return $address['location']['address'];
        } catch (\Exception $e) {
            return null;
        }
    }

}