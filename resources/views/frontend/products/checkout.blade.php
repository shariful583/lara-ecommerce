@extends('frontend.layouts.master')

@section('main')

    @guest()

            <div class="py-5 text-center">
               <span class="alert alert-info">
                    You need to <a href="{{route('user.login')}}">login</a> first to complete your order.
               </span>
            </div>

    @endguest


    @auth()

    <div class="container">
        <div class="py-5 text-center">
            <h2>Checkout form</h2>
        </div>

        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                    <span class="badge badge-secondary badge-pill">{{count($cart)}}</span>
                </h4>
                <ul class="list-group mb-3">
                    @foreach($cart as $key => $item)
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">{{$item['title']}}</h6>
                            <small class="text-muted">Quantity: {{$item['quantity']}}</small>
                        </div>
                        <span class="text-muted">{{number_format($item['total_price'], 2)}}</span>
                    </li>
                    @endforeach

                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-success">
                            <h6 class="my-0">Promo code</h6>
                            <small></small>
                        </div>
                        <span class="text-success"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (BDT)</span>
                        <strong>{{number_format($total,2)}}</strong>
                    </li>
                </ul>

            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Billing address</h4>
                <form class="needs-validation" action="{{route('order')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="Name">Customer Name</label>
                        <input type="text" class="form-control" name="c_name" value="{{auth()->user()->name}}" required>
                        <div class="invalid-feedback">
                            Valid Name is required.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="phone">Customer Phone</label>
                        <input type="text" class="form-control" name="c_phone" value="{{auth()->user()->phone}}">
                    </div>

                    <div class="mb-3">
                        <label for="address">Address</label>
                        <textarea class="form-control" name="c_address" required></textarea>
                    </div>


                    <div class="mb-3">
                        <label for="city">City</label>
                        <input type="text" class="form-control" name="city">
                    </div>

                    <div class="mb-3">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" class="form-control" name="postal_code">
                    </div>

                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
                </form>
            </div>
        </div>

    @endauth

    @endsection
