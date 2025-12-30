@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')

<div class="layout">
    <div class="content-header">
        <h1>@if(request('name'))
        “{{ request('name') }}”の
        @endif商品一覧</h1>
        <a href="/products/register" class="button">
            ＋商品登録
        </a>
    </div>

    <div class="content">

        <aside class="sidebar">
            <form class="sidebar-content" action="/products/search" method="GET">
                @csrf
                <input type="text" name="name" value="{{ request('name') }}" placeholder="商品名で検索">
                <button type="submit">
                    <span>検索</span>
                </button>
                <h2>価格順で表示</h2>
                    <select name="sort" onchange="this.form.submit()">
                        <option value=""></option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }} >高い順に表示</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }} >低い順に表示</option>
                    </select>
            </form>
        </aside>

        <div class="card">
            @foreach($products as $product)
                <a href="/products/{{$product->id}}">
                    <article class="shadow">
                        <div class="content-img">
                            <img src="{{ $product->image_url }}">
                        </div>
                        <div class="text">
                            <span>{{ $product->name }}</span>
                            <span>￥{{ $product->price }}</span>
                        </div>
                    </article>
                </a>
            @endforeach
        </div>

    </div>

    <div class="pagination">
    {{ $products->links() }}
    </div>
</div>


@endsection