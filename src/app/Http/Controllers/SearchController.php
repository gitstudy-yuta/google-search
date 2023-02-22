<?php

namespace App\Http\Controllers;

use App\Service\SearchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class SearchController extends Controller
{   
    private $service = null;

    public function __construct(SearchService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $error        = null;
        $responseData = null;

        $inputs = $this->getInputs($request);
        if($inputs["searchKey"]){
            $result = $this->service->requestApi($inputs["searchKey"], $inputs["sort"], $inputs["index"]);
            if(isset($result["error"])){
                $error = $result["error"];
            }
            $responseData = $result;
        }
        return view("index",["error"       => $error,
                            "responseData" => $responseData,
                            "inputs"       => $inputs]);
    }

    public function getInputs($request)
    {
        return [
            "searchKey" => trim($request->searchKey),
            "sort"      => $request->sort ?? "asc",
            "index"     => $request->index ?? 1,
        ];
    }

}
