@extends('frontend.layouts.master')

@section('main')
<div class="container">
    <div class="card">
        <div class="row">
            <aside class="col-sm-5 border-right">
                <article class="gallery-wrap">
                    <div>
                        <img src="{{ $product->getFirstMediaUrl('products') }}" alt="Not found" class="card-img-top">
                    </div>
                </article>
            </aside>

            <aside class="col-sm-7">
                <article class="card-body p-5">
                    <h3 class="title mb-3">
                        {{$product->title}}
                    </h3>
                    <dl class="item-peoperty">
                        <dt>
                            {{$product->description}}
                        </dt>
                        <dd><p>Jou</p></dd>
                    </dl>

                    <p class="price-detail-wrap">
                        <span class="price h3 text-warning">
                            <span class="currency">
                                BDT
                            </span>
                            <span class="num">
                                {{$product->price}}
                            </span>
                        </span>
                    </p>
                    <hr>

                        <form action="{{route('cart.add')}}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$product['id']}}">
                            <button type="submit" class="btn btn-sm btn-outline-secondary">Add to cart</button>
                        </form>
                </article>
            </aside>
        </div>
    </div>
</div>

@stop
