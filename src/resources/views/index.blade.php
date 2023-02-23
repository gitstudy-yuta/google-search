@extends('layout')
@section('title', 'ページタイトル')
@section('js')
<script src="{{asset('/js/search_index.js')}}"></script>
<script>
    const searchUrl = "{{route('index')}}";
</script>
@endsection
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
    <div class="row">
        <div class="col-lg-10 col-md-8 mx-auto">
            @if(isset($result["error"]))
                <div>{{$result["error"]}}</div>
            @endif
            @if(isset($result["datas"]))
                @if(count($result["datas"]) > 0)
                    <div class="mb-3 d-flex justify-content-between align-items-end">
                        <div class="fs-4">検索結果</div> 
                        <div>{{$inputs["index"] * config("const.page_count")}}/{{$result["totalResut"]}}<span class="ms-1">件</span></div>
                    </div>
                    <div class="list-group">
                        @foreach($result["datas"] as $data)
                            <a href="{{$data['link']}}" class="list-group-item list-group-item-action" aria-current="true" target="_blank">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1 text-primary">{{$data['title']}}</h5>
                                </div>
                                <p class="mb-1 text-start fs-6 text-secondary">{{$data['snippet']}}</p>
                            </a>
                        @endforeach
                    </div>
                    @if($result["hasNext"])
                    <div class="d-flex justify-content-end mt-3">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                @php
                                if(is_int($result["totalResut"] / config("const.page_count"))){
                                    $lastPageIndex = $result["totalResut"] / config("const.page_count");
                                }else{
                                    $lastPageIndex = $result["totalResut"] / config("const.page_count") + 1;
                                }
                                $lastPageIndex = intval($lastPageIndex);
                                @endphp
                                <li class="page-item send_page {{$inputs['index'] === 1 ? 'disabled' : ''}}" data-index="1"><a class="page-link"><<</a></li>
                                <li class="page-item send_page {{$inputs['index'] === 1 ? 'disabled' : ''}}" data-index="{{$inputs['index'] - 1}}"><a class="page-link"><</a></li>
                                <li class="page-item send_page {{$inputs['index'] == $lastPageIndex ? 'disabled' : ''}}" data-index="{{$inputs['index'] + 1}}"><a class="page-link">></a></li>
                            </ul>
                        </nav>
                    </div>
                    @endif
                @endif
            @endif
        </div>
    </div> 
</section>
@endsection