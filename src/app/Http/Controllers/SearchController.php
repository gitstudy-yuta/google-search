<?php

namespace App\Http\Controllers;

use App\Service\SearchService;
use Illuminate\Http\Request;

class SearchController extends Controller
{   
    private $service = null;

    public function __construct(SearchService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $result = null;
        $inputs = $this->getInputs($request);
        if($inputs["searchKey"]){
            $result = $this->service->requestApi($inputs["searchKey"], $inputs["index"]);
        }
        
        return view("index",["result"   => $result,
                            "inputs"    => $inputs]);
    }

    public function getInputs($request)
    {
        return [
            "searchKey" => trim($request->searchKey),
            "index"     => $request->has("index") ? (int)$request->index : 1,
        ];
    }

}
