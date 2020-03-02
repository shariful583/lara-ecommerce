@extends('frontend.layouts.master')

@section('main')
    <div class="container">
        <br>
        <p class="text-center">
            Cart
        </p>

        @if(empty($cart))
            <div class="alert alert-success">Please add some products</div>
            @else

        <table class="table table-bordered">
            <thead>
            <tr>
                <td>Product Serial</td>
                <td>Product</td>
                <td>Unit Price</td>
                <td>Quantity</td>
                <td>Price</td>
                <td>Action</td>
            </tr>
            </thead>

            <tbody>
            @php
            $i = 1
            @endphp
            @foreach($cart as $key => $product)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$product['title']}}</td>
                <td>{{$product['unit_price']}}</td>
                <td>{{$product['quantity']}}</td>
                <td>{{number_format($product['total_price'],2)}}</td>
                <td>
                    <form action="{{route('cart.remove')}}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$key}}">
                        <button type="submit" class="btn btn-sm btn-outline-secondary"><i class="fas fa-minus">

                            </i></button>
                    </form>
                </td>
            </tr>
                @endforeach

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Total</td>
                <td>BDT {{number_format($total,2)}}</td>
                <td></td>
            </tr>
            </tbody>
        </table>
            <a href="{{route('cart.clear')}}"><i class="fa fa-trash fa-2x" style="color: red"></i></a>
            <a href="{{route('cart.checkout')}}"><i class="fa fa-shopping-cart fa-2x" style="color: darkgreen"></i></a>
            @endif

    </div>
@endsection
