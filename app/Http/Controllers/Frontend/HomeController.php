<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
//select(['id','category_id','title','slug','description','in_stock','price'])
class HomeController extends Controller
{
    public function showHomePage(){
        $data = [];
        $data['products'] = Product::all()->where('active',1);
       return view('frontend.home',$data);
    }
}
