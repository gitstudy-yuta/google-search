@extends('layout')
@section('title', 'ページタイトル')
@section('content')
<section class="py-5 text-center container">
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light mb-5">Custom Search</h1>
            <div>
                <form class="d-flex" method="GET" href="{{route('index')}}">
                    <input class="form-control me-2" name="searchKey" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-8 mx-auto">
            <div>結果一覧</div>
        </div>
    </div>
</section>
@endsection