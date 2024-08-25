<?php
namespace App\Services;
use App\Models\Product;

class CheckoutService
{
    private array $pricing_rules = [
        'FR1'=> ['get_one_free', null, null],
        'SR1'=> ['bulk_discount', 3, 4.50],
         ];
    public float $total = 0;
    private array $cart;
    public function __construct() {
      $this->cart  = session()->get('cart', []);
    }

    public function scan(string $item):void
    {
      $product = Product::where('code', $item)->first();
      if ($product) {
            /* add scaned product object to the array $cart and save $cart in the session */
        array_push($this->cart, $product);
        session()->put('cart', $this->cart);
        $this->total = $this->getTotal();
      }

   }
   public function getScanedProducts() : array
   {
       $collection = collect( $this->cart );
       $plucked = $collection->pluck('code');
       return $plucked->all();
   }
  /*  return array: key is product code, value is quontity */
    public function getProductsQuantity() : array
    {
        $scanedProducts = $this->getScanedProducts();
        return array_count_values ($scanedProducts);

    }
    public function getTotal():float
    {
      $scaned_products = $this->getProductsQuantity();

    // $cart_products = Cart::query()
            // ->join('product', 'cart.product_id', '=', 'product.id')
            // ->selectRaw('product.product_code, product.price, sum(carts.qty) as quantity')
            // ->groupByRaw('product.product_code, product.price')
            // ->get();

        $total = 0;
        $products = collect($this->cart);

        foreach ( $scaned_products as $code=>$quantity )
        {
            $rule = $this->pricing_rules[$code]?? NULL;
            $quantity_by_code = $this->getProductsQuantity();

            $product = $products->firstWhere('code', $code);

            if(!is_null($rule)) {
            info('discound' . 'prod'. $code . '(' . $quantity_by_code[$code].')' . 'sum=' . call_user_func_array([$this, $rule[0]], [$product, $rule[1], $rule[2]]));
            $total += call_user_func_array([$this, $rule[0]], [$product, $rule[1], $rule[2]]);
             } else {
            info('no discound');
             $total+=$quantity_by_code[$code]*$product->price;
            }
        }
      info('-----');
      return $total;
    }
    private function get_one_free($product, $rule1, $rule2):float
    {
        $quantity_by_code = $this->getProductsQuantity();

        $quantity = floor($quantity_by_code[$product->code] / 2)+($quantity_by_code[$product->code] % 2);
        info($product->code . ":price=" .  $product->price . ":q=" . $quantity);  /* output in storage/logds/laravel.log */

        return $quantity*$product->price;
    }

    private function bulk_discount($product, $rule1, $rule2):float
    {
        $quontity_by_code = $this->getProductsQuantity();
        $price = $product->price;
        if($quontity_by_code[$product->code]>=$rule1)
        {
         $price=$rule2;
        }
        return $quontity_by_code[$product->code]*$price;
    }

    public function remove(string $product_code): void
    {
        $products = $this->cart;
        foreach ($products as $key=>$product){
          if ($product->code===$product_code) {
            unset($products[$key]);
            break;
          }

        }
        session()->put('cart', $products);
    }
}
