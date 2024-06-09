@extends('frontend.layout')
@section('title')
    Shop
@endsection
@section('content')
<main class="shop">
    <section>
        <div class="container">
            <div class="row">
                <div class="col-9">
                    <div class="row">
                        @foreach ($products as $productVal)
                        {{-- check status is promotion --}}
                        @if ($productVal->sale_price > 0)
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
                        <div class="col-4">
                            <figure>
                                <div class="thumbnail">
                                    <div class="status {{ $headLine }}">
                                        Promotion
                                    </div>
                                    <a href="/product/{{ $productVal->slug }}">
                                        <img src="/uploads/{{$productVal->thumbnail}}" alt="">
                                    </a>
                                </div>
                                <div class="detail">
                                    <div class="price-list">
                                        <div class="price {{ $nonePromotion }}">US {{$productVal->regular_price}}</div>

                                        <div class="regular-price {{ $promotion }}"><strike> US {{$productVal->regular_price}}</strike></div>
                                        <div class="sale-price {{ $promotion }}">US {{$productVal->sale_price}}</div>
                                    </div>
                                    <h5 class="title">{{$productVal->name}}</h5>
                                </div>
                            </figure>
                        </div>
                    @endforeach

                        <div class="col-12">
                            <ul class="pagination">
                                @for ($i = 1; $i <= $page; $i++)
                                    <li>
                                        <a href="/shop?page={{$i}}">{{$i}}</a>
                                    </li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-3 filter">
                    <h4 class="title">Category</h4>
                    <ul>
                        <li>
                            <a href="/shop">ALL</a>
                        </li>
                        @foreach ($category as $catVal)
                            <li>
                                <a href="/shop?cat={{ $catVal->slug }}">{{ $catVal->name }}</a>
                            </li>
                        @endforeach
                    </ul>

                    <h4 class="title mt-4">Price</h4>
                    <div class="block-price mt-4">
                        <a href="/shop?price=max">High</a>
                        <a href="/shop?price=min">Low</a>
                    </div>

                    <h4 class="title mt-4">Promotion</h4>
                    <div class="block-price mt-4">
                        <a href="/shop?promotion=true">Promotion Product</a>
                    </div>

                </div>
            </div>
        </div>
    </section>

</main>
@endsection
