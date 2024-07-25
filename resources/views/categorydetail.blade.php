@extends('layouts')

@section('content')
<div class="product-main">
    <h2 class="title">{{ sizeof($products) != 0 ? $products[0]->category->name : '' }}</h2>
    <div class="product-grid">
        @foreach($products as $pr)
        <div class="showcase">
            <div class="showcase-banner">
            <img src="{{ asset($pr->photo ? 'image/photo-product/' . $pr->photo : '') }}" alt="{{ $pr->name }}" width="300" class="product-img default">
            <img src="{{ asset($pr->photo ? 'image/photo-product/' . $pr->photo : '') }}" alt="{{ $pr->name }}" width="300" class="product-img hover">
            <!-- <p class="showcase-badge">15%</p> -->
            <p class="showcase-badge angle">new</p>
            <div class="showcase-actions">
                <button class="btn-action">
                <ion-icon name="eye-outline"></ion-icon>
                </button>
                <button class="btn-action">
                <ion-icon name="bag-add-outline"></ion-icon>
                </button>
            </div>
            </div>
            <div class="showcase-content">
            <a href="{{ route('productdetail', ['code' => $pr->code]) }}" class="showcase-category">{{ $pr->name }}</a>
            <a href="{{ route('productdetail', ['code' => $pr->code]) }}">
                <h3 class="showcase-title">{{ substr($pr->description, 0, 30) . ' ....' }}</h3>
            </a>
            <div class="price-box">
                <p class="price">Rp. {{ number_format($pr->price, 0, ',', '.') }}</p>
            </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection