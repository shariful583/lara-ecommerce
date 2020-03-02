@extends('frontend.layouts.master')


@section('main')

<div class="container">
    <h2>Order Details</h2>
    <ul class="list-group">
        <li class="list-group-item">Order Id: {{$order->id}}</li>
        <li class="list-group-item">Customer Name: {{$order->customer_name}}</li>
        <li class="list-group-item">Customer Phone: {{$order->customer_phone}}</li>
        <li class="list-group-item">Customer Address: {{$order->address}}</li>
        <li class="list-group-item">Total Amount: {{$order->total_amount}}</li>
    </ul>

    <br>
    <hr>
    <h2>Product Details</h2>



        <table class="table table-responsive-md">
            <thead>
            <tr class="bg-info">
                <th scope="col">Product Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->products as $product)
                <tr class="bg-light">
                    <td>{{$product->product->title}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>{{$product->price}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

</div>
@endsection
