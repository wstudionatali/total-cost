<html>
<body>
  <ul>
   @foreach ( $products as $product )
     <li>{{$product->name}}(${{number_format($product->price, 2)}})
     <a href="{{route('scan', $product->code)}}">Scan</a>
     <a href="{{route('remove', $product->code)}}">Remove</a>
    </li>
   @endforeach
 </ul>
 <a href="{{route('remove_all')}}">Remove all</a>
<hr>
 <b>Scaned products:</b>
 <ul>
    @foreach ($cart_product_codes as $code=>$quantity)
      <li>{{$code}}:{{$quantity}}</li>
    @endforeach
  </ul>
 <b>
 Total: ${{number_format($total_price, 2)}}
 </b>
</body>
</html>
