@extends('frontend.layouts.master')

    @section('main')

        <table class="table table-responsive-md">
            <thead>
            <tr class="bg-info">
                <th scope="col">Order Id</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Customer Phone</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
            <tr class="bg-light">
                <td>{{$order->id}}</td>
                <td>{{$order->customer_name}}</td>
                <td>{{$order->customer_phone}}</td>
                <td>Product Name</td>
                <td>Product Quantity</td>
                <td>{{$order->total_amount}}</td>
                <td><a href="{{route('order.details',$order->id)}}">Details</a></td>
            </tr>
                @endforeach
            </tbody>
        </table>


    @endsection
