<h1>修改商品:  {{ $product->name }}</h1>
<ul>
    <li>id: {{ $product->id }}</li>
    <li>price: {{ $product->price }}</li>
    <li>market_price: {{ $product->market_price }}</li>
    <li>create_at: {{ $product->create_at }}</li>
</ul>
<img src="{{ $message->embed(public_path('uploads/'.$mainImage->path)) }}" alt="">