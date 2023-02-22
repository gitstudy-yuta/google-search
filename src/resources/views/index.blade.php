@extends('layout')
@section('title', 'ページタイトル')
@section('content')
<section class="py-5 text-center container">
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light mb-5">Custom Search</h1>
            <div>
                <form class="d-flex" method="GET" href="{{route('index')}}">
                    <input class="form-control me-2" name="searchKey" type="search" placeholder="Search" aria-label="Search" value="{{$inputs['searchKey']}}">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>
    @if($responseData)
        <div class="row">
            <div class="col-lg-10 col-md-8 mx-auto">
                @if(count($responseData["datas"]) > 0)
                    <div class="mb-3">検索結果</div>
                    <div class="list-group">
                        @foreach($responseData["datas"] as $data)
                            <a href="{{$data['link']}}" class="list-group-item list-group-item-action" aria-current="true">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{$data['title']}}</h5>
                                </div>
                                <p class="mb-1">{{$data['snippet']}}</p>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div>検索結果なし</div>
                @endif
            </div>
        </div>
    @endif
</section>
@endsection