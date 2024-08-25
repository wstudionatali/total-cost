<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Facades\App\Services\CheckoutService;
class HomeController extends Controller
{
    public function index ()
    {
        $products = Product::all();
        $total_price = CheckoutService::getTotal();
        $cart_product_codes = CheckoutService::getProductsQuantity();
      return view('home', compact('products', 'total_price', 'cart_product_codes'));

    }
    public function scan ($product_code)
    {
      CheckoutService::scan($product_code);
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
      CheckoutService::remove($product_code);
      return redirect(route('home'));
    }
}
