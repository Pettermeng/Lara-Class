@extends('frontend.layout')
@section('title')
    Home
@endsection
@section('content')
    <main class="home">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="main-title">
                            NEW PRODUCTS
                        </h3>
                    </div>
                </div>
                <div class="row">
                    @foreach ($newProducts as $newProductsVal)
                        {{-- check status is promotion --}}
                        @if ($newProductsVal->sale_price > 0)
                            @php
                                $headLine      = 'd-block';
                                $promotion     = 'd-block';
                                $nonePromotion = 'd-none';
                            @endphp
                        @else
                            @php
                                $headLine      = 'd-none';
                                $promotion     = 'd-none';
                                $nonePromotion = 'd-block';
                            @endphp
                        @endif
                        <div class="col-3">
                            <figure>
                                <div class="thumbnail">
                                    <div class="status {{ $headLine }}">
                                        Promotion
                                    </div>
                                    <a href="/product/{{ $newProductsVal->slug }}">
                                        <img src="/uploads/{{$newProductsVal->thumbnail}}" alt="">
                                    </a>
                                </div>
                                <div class="detail">
                                    <div class="price-list">
                                        <div class="price {{ $nonePromotion }}">US {{$newProductsVal->regular_price}}</div>

                                        <div class="regular-price {{ $promotion }}"><strike> US {{$newProductsVal->regular_price}}</strike></div>
                                        <div class="sale-price {{ $promotion }}">US {{$newProductsVal->sale_price}}</div>
                                    </div>
                                    <h5 class="title">{{$newProductsVal->name}}</h5>
                                </div>
                            </figure>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="main-title">
                            PROMOTION PRODUCTS
                        </h3>
                    </div>
                </div>
                <div class="row">
                    @foreach ($promoProducts as $promoProductsVal)
                        {{-- check status is promotion --}}
                        @if ($promoProductsVal->sale_price > 0)
                            @php
                                $headLine      = 'd-block';
                                $promotion     = 'd-block';
                                $nonePromotion = 'd-none';
                            @endphp
                        @else
                            @php
                                $headLine      = 'd-none';
                                $promotion     = 'd-none';
                                $nonePromotion = 'd-block';
                            @endphp
                        @endif
                        <div class="col-3">
                            <figure>
                                <div class="thumbnail">
                                    <div class="status {{ $headLine }}">
                                        Promotion
                                    </div>
                                    <a href="/product/{{ $promoProductsVal->slug }}">
                                        <img src="/uploads/{{$promoProductsVal->thumbnail}}" alt="">
                                    </a>
                                </div>
                                <div class="detail">
                                    <div class="price-list">
                                        <div class="price {{ $nonePromotion }}">US {{$promoProductsVal->regular_price}}</div>

                                        <div class="regular-price {{ $promotion }}"><strike> US {{$promoProductsVal->regular_price}}</strike></div>
                                        <div class="sale-price {{ $promotion }}">US {{$promoProductsVal->sale_price}}</div>
                                    </div>
                                    <h5 class="title">{{$promoProductsVal->name}}</h5>
                                </div>
                            </figure>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="main-title">
                            POPULAR PRODUCTS
                        </h3>
                    </div>
                </div>
                <div class="row">
                    @foreach ($mostViewProducts as $mostViewProductsVal)
                        {{-- check status is promotion --}}
                        @if ($mostViewProductsVal->sale_price > 0)
                            @php
                                $headLine      = 'd-block';
                                $promotion     = 'd-block';
                                $nonePromotion = 'd-none';
                            @endphp
                        @else
                            @php
                                $headLine      = 'd-none';
                                $promotion     = 'd-none';
                                $nonePromotion = 'd-block';
                            @endphp
                        @endif
                        <div class="col-3">
                            <figure>
                                <div class="thumbnail">
                                    <div class="status {{ $headLine }}">
                                        Promotion
                                    </div>
                                    <a href="/product/{{ $mostViewProductsVal->slug }}">
                                        <img src="/uploads/{{$mostViewProductsVal->thumbnail}}" alt="">
                                    </a>
                                </div>
                                <div class="detail">
                                    <div class="price-list">
                                        <div class="price {{ $nonePromotion }}">US {{$mostViewProductsVal->regular_price}}</div>

                                        <div class="regular-price {{ $promotion }}"><strike> US {{$mostViewProductsVal->regular_price}}</strike></div>
                                        <div class="sale-price {{ $promotion }}">US {{$mostViewProductsVal->sale_price}}</div>
                                    </div>
                                    <h5 class="title">{{$mostViewProductsVal->name}}</h5>
                                </div>
                            </figure>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

    </main>
@endsection
