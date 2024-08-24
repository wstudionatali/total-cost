<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Services\CheckoutService;
class HomeController extends Controller
{
    public function index ()
    {   //session()->forget('cart');
        $products = Product::all();
        $total_price = (new CheckoutService)->getTotal();
        $cart_product_codes = (new CheckoutService)->getProductsQuantity();
      return view('home', compact('products', 'total_price', 'cart_product_codes'));

    }
    public function scan ($product_code)
    {
      (new CheckoutService)->scan($product_code);
      return redirect(route('home'));
    }
    public function remove_all ()
    {
        //session()->flush()
      session()->forget('cart');
      return redirect(route('home'));
    }
    public function remove ($product_code)
    {
      (new CheckoutService)->remove($product_code);
      return redirect(route('home'));
    }
}
