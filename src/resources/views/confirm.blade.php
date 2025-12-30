@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
@endsection

@section('content')


<div class="layout">
    <nav class="breadcrumb">
        <ol>
            <li><a href="/products">商品一覧</a></li>
            <li aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>
    <form action="/products/{{$product->id}}/update" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex">
            <div class="flex-img">
                <img src="{{ $product->image_url }}">
                <input type="file" name="image">
                @foreach ($errors->get('image') as $message)
                    <span class="error-text">{{ $message }}</span>
                @endforeach
            </div>

            <div class="flex-text">
                <div class="text-layout">
                    <p>商品名</p>
                    <input type="text" name="name" value="{{ $product->name }}">
                    @foreach ($errors->get('name') as $message)
                        <span class="error-text">{{ $message }}</span>
                    @endforeach
                </div>

                <div class="text-layout">
                    <p>値段</p>
                    <input type="text" name="price" value="{{ $product->price }}">
                    @foreach ($errors->get('price') as $message)
                        <span class="error-text">{{ $message }}</span>
                    @endforeach
                </div>

                <div class="checkbox-layout">
                    <p>季節</p>
                    <div class="checkbox-list">
                        @foreach ($seasons as $season)
                            <label class="checkbox-item">
                                <input type="checkbox" name="season_ids[]" value="{{ $season->id }}"
                                {{ $product->seasons->contains('id', $season->id) ? 'checked' : '' }}>
                                <span>{{ $season->name }}</span>
                            </label>
                        @endforeach

                        @foreach ($errors->get('season_ids') as $message)
                            <span class="error-text">{{ $message }}</span>
                        @endforeach
                    </div>
                </div>

            </div>


        </div>

        <div class="text-layout">
            <p>商品説明</p>
            <textarea  name="description" >{{ $product->description }}</textarea>

            @foreach ($errors->get('description') as $message)
                <span class="error-text">{{ $message }}</span>
            @endforeach
        </div>


        <div class="flex-button">
            <div class="button-layout">
                <a href="/products" class="button">
                戻る
                </a>
                <button type="submit">変更を保存</button>
            </div>
        </div>
    </form>
    <form action="/products/{{ $product->id }}/delete" method="POST">
        @csrf
        <button class="reset-button" type="submit">変更を保存</button>
    </form>
</div>

@endsection