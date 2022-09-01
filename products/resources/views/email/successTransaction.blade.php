<h1>{{ $name }} 您所下的訂單已成功建立</h1>
<p>以下是訂單相關訊息:</p>
<p>訂單編號: {{ $transaction_id }}</p>
<hr>
<p>訂單金額: {{ $total_price }}</p>
<hr>
<p>訂單運費: {{ $delivery_money }}</p>
<hr>
<ul>
@foreach( $products as $product )
    <li>商品名稱: {{ $product['name'] }} | 商品數量: {{ $product['num'] }} | 商品單價: {{ $product['price'] }}</li>
@endforeach
</ul>

