<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Notifications\OrderEmailNotifiaction;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use mysql_xdevapi\Exception;

class CartController extends Controller
{
    public function showCart(){
        $data = [];

        $data['cart'] = session()->has('cart') ? session()->get('cart') : [];
        $data['total'] = array_sum(array_column($data['cart'],'total_price'));
        return view('frontend.products.cart', $data);

    }

    public function addToCart(Request $request){
        try {
            $request->validate([
                'product_id' => 'required',
            ]);
        } catch (ValidationException $e){
           return redirect()->back();
        }

        $product = Product::findOrfail($request->input('product_id'));
        $unit_price=($product->sale_price == null && $product->sale_price > 0) ? $product->sale_price : $product->price;


        $cart = session()->has('cart') ? session()->get('cart') : [];


            if (array_key_exists($product->id, $cart)){
                $cart[$product->id]['quantity']++;
                $cart[$product->id]['total_price']= $cart[$product->id]['quantity'] * $cart[$product->id]['unit_price'];
            } else {
                    $cart[$product->id] = [
                        'title' => $product->title,
                        'quantity' => 1,
                        'unit_price' => $unit_price,
                        'total_price' => $unit_price,
                ];
            }

        session(['cart' => $cart]);

        return redirect()->route('cart.show');
    }

    public function removeFromCart(Request $request){
        try {
            $request->validate([
                'product_id' => 'required',
            ]);
        } catch (ValidationException $e){
            return redirect()->back();
        }


        $cart = session()->has('cart') ? session()->get('cart') : [];
        unset($cart[$request->input('product_id')]);
        session(['cart' => $cart]);
        return redirect()->back();
}


    public function clearFromCart(){
        session(['cart' => []]);
        return redirect()->back();
    }



    public function checkout(){
        $data = [];
        $data['cart'] = session()->has('cart') ? session()->get('cart') : [];
        $data['total'] = array_sum(array_column($data['cart'],'total_price'));
        return view('frontend.products.checkout',$data);
    }


    public function processOrder(Request $request){

        $validator = Validator::make($request->all(), [
            'c_name' => 'required',
            'c_phone' => 'required',
            'c_address' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }


        $cart = session()->has('cart') ? session()->get('cart') : [];
        $total = array_sum(array_column($cart,'total_price'));
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'customer_name' => $request->input('c_name'),
            'customer_phone' => $request->input('c_phone'),
            'address' => $request->input('c_address'),
            'city' => $request->input('city'),
            'postal_code' => $request->input('postal_code'),
            'total_amount' => $total,
            'paid_amount' => $total,
            'payment_details' => 'Cash on Delivery',
        ]);

        foreach ($cart as $id => $product){
            $order->products()->create([
                'product_id' => $id,
                'quantity' => $product['quantity'],
                'price' => $product['total_price'],
            ]);
        }

        //Use Notification with Queue

        //auth()->user()->notify(new OrderEmailNotifiaction($order,auth()->user()->name));


        //Session Message
        session()->forget(['total','cart']);
        session()->flash('type','success');
        session()->flash('message','Order Successfully completed.');

        return redirect('/');

    }


    public function orderDetails($id){
        $data=[];

        $data['order'] = Order::with('products','products.product')->findOrFail($id);
        return view('frontend.order_details',$data);
    }
}






















