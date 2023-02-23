<?php

namespace App\Service;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SearchService {

    private $URL = "https://customsearch.googleapis.com/customsearch/v1";
    private $ID = "e4e24ba9e4f2e464c";
    private $APIKEY = "AIzaSyAgAK_iT1RPt0om6bjyswUJY8pr5LgIGDc";

    public function requestApi($searchKey, $index)
    {
        $result = [];
        try{
            $start = 1;
            if($index !== 1){
                $start = ($index - 1) . "1";
            }
            
            $response = Http::retry(3, 100)->get($this->URL, [
                'key'   => $this->APIKEY,
                'hl'    => "ja",
                'cx'    => $this->ID,
                'q'     => $searchKey,
                'start' => (int)$start,
            ]);
        
            if($response->status() != 200){
                throw new Exception(__("messages.api_error"));
            }

            $responseBody = json_decode($response->body());
            $totalResut = $responseBody->searchInformation->totalResults;
            $hasNext    = isset($responseBody->queries->nextPage);
            $items      = $responseBody->items ?? [];
            $datas = [];
            foreach($items as $item){
                $data = [
                    "title"     => $item->title,
                    "link"      => $item->link,
                    "snippet"   => $item->snippet,
                ];
                $datas[] = $data;
            }
            $result = [
                "totalResut"    => (int)$totalResut,
                "hasNext"       => $hasNext,
                "datas"         => $datas,
            ];
        }catch(Exception $e){
            Log::error($e->getMessage());
            $result = [
                "error" => __("messages.internal_error")
            ];
        }
        return $result;
    }

}