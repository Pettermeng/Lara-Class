@extends('frontend.layout')
@section('title')
    Product Detail
@endsection
@section('content')
<main class="product-detail">

    <section class="review">
        <div class="container">
            <div class="row">
                <div class="col-5">
                    <div class="thumbnail">
                        <img src="/uploads/{{ $product[0]->thumbnail }}" alt="">
                    </div>
                </div>
                <div class="col-7">
                    <div class="detail">
                        <div class="price-list">
                            @if ($product[0]->sale_price > 0)
                                <div class="regular-price"><strike> US {{ $product[0]->regular_price }}</strike></div>
                                <div class="sale-price">US {{ $product[0]->sale_price }}</div>
                            @else
                                <div class="price">US {{ $product[0]->regular_price }}</div>
                            @endif

                        </div>
                        <h5 class="title">{{ $product[0]->name }}</h5>
                        <div class="group-size">
                            <span class="title">Color Available</span>
                            <div class="group">
                                {{ $product[0]->attribute_color }}
                            </div>
                        </div>
                        <div class="group-size">
                            <span class="title">Size Available</span>
                            <div class="group">
                                {{ $product[0]->attribute_size }}
                            </div>
                        </div>
                        <div class="group-size">
                            <span class="title">Description</span>
                            <div class="description">
                                {{ $product[0]->description }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="main-title">
                        RELATED PRODUCTS
                    </h3>
                </div>
            </div>
            <div class="row">
                @foreach ($relatedPro as $relatedProVal)
                    {{-- check status is promotion --}}
                    @if ($relatedProVal->sale_price > 0)
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
                                <a href="/product/{{ $relatedProVal->slug }}">
                                    <img src="/uploads/{{$relatedProVal->thumbnail}}" alt="">
                                </a>
                            </div>
                            <div class="detail">
                                <div class="price-list">
                                    <div class="price {{ $nonePromotion }}">US {{$relatedProVal->regular_price}}</div>

                                    <div class="regular-price {{ $promotion }}"><strike> US {{$relatedProVal->regular_price}}</strike></div>
                                    <div class="sale-price {{ $promotion }}">US {{$relatedProVal->sale_price}}</div>
                                </div>
                                <h5 class="title">{{$relatedProVal->name}}</h5>
                            </div>
                        </figure>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

</main>
@endsection
