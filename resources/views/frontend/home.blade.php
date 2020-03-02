@extends('frontend.layouts.master')

@section('main')
{{--    <section class="jumbotron text-center">--}}
{{--        <div class="container">--}}
{{--            <h1>Album example</h1>--}}
{{--            <p class="lead text-muted">Something shorty.</p>--}}
{{--            <p>--}}
{{--                <a href="#" class="btn btn-primary my-2">Main call to action</a>--}}
{{--                <a href="#" class="btn btn-secondary my-2">Secondary action</a>--}}
{{--            </p>--}}
{{--        </div>--}}
{{--    </section>--}}



    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row">
                @foreach($products as $product)

                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <a href="{{route('frontend.details',$product->slug)}}"><img class="card-img-top" src="{{ $product->getFirstMediaUrl('products') }}" alt="Not Found"></a>
                        <div class="card-body">
                            <a href="{{route('frontend.details',$product->slug)}}"><p class="card-text">{{Str::limit($product->title,60)}}</p></a>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <form action="{{route('cart.add')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        <button type="submit" class="btn btn-sm btn-outline-secondary">Add to cart</button>
                                    </form>
                                </div>
                                <small class="text-muted">{{$product->price}}</small>
                            </div>
                        </div>
                    </div>
                </div>
                 @endforeach

            </div>


        </div>
    </div>




@stop
