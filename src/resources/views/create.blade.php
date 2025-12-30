@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create.css') }}" />
@endsection

@section('content')
<div class="layout">
    <h1>商品登録</h1>
    <form class="form-layout"  action="/products/register" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="title-layout">
            商品名<span class="required">必須</span>
        </div>

        <div class="text-layout">
            <input type="text" name="name" placeholder="商品名を入力">
            @foreach ($errors->get('name') as $message)
            <span class="error-text">{{ $message }}</span>
            @endforeach
        </div>

        <div class="title-layout">
            値段<span class="required">必須</span>
        </div>
        <div class="text-layout">
            <input type="text" name="price" placeholder="値段を入力">
            @foreach ($errors->get('price') as $message)
            <span class="error-text">{{ $message }}</span>
            @endforeach
        </div>

        <div class="title-layout">
            商品画像<span class="required">必須</span>
        </div>
        <div>
            <input type="file" name="image">
            @foreach ($errors->get('image') as $message)
            <span class="error-text">{{ $message }}</span>
            @endforeach
        </div>

        <div class="title-layout">
            季節<span class="required">必須</span><span class="text-red">複数選択可</span>
        </div>
        <div class="checkbox-group">
            <label class="checkbox-item">
                <input type="checkbox" name="season_ids[]" value="1">
                <span>春</span>
            </label>

            <label class="checkbox-item">
                <input type="checkbox" name="season_ids[]" value="2">
                <span>夏</span>
            </label>

            <label class="checkbox-item">
                <input type="checkbox" name="season_ids[]" value="3">
                <span>秋</span>
            </label>

            <label class="checkbox-item">
                <input type="checkbox" name="season_ids[]" value="4">
                <span>冬</span>
            </label>

            @foreach ($errors->get('season_ids') as $message)
                <span class="error-text">{{ $message }}</span>
            @endforeach
        </div>

        <div class="title-layout">
            商品説明<span class="required">必須</span>
        </div>
        <div class="text-layout">
            <textarea name="description" placeholder="商品の説明を入力"></textarea>
            @foreach ($errors->get('description') as $message)
            <span class="error-text">{{ $message }}</span>
            @endforeach
        </div>

        <div class="flex-button">
            <a href="/products" class="button">
                戻る
            </a>
            <button type="submit">登録</button>
        </div>

    </form>


</div>

@endsection