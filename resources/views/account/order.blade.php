<div class="user-account__accord" style="width: 100%">
    <div class="order-header">
        <p>Дата</p>
        <p>Номер заказа</p>
        <p>Статус заказа</p>
    </div>
    <div class="accordion">
        @foreach($orders as $num=>$order)
            <div class="accordion-header">
                <p>{{$order['date']}}</p>
                <p>{{$num}}</p>
                <p>{{$order['status']['_status']}}</p>
            </div>
            <div class="accordion-body" style="display: none;">

            @foreach($order['products'] as $product)
                    <div class="order__product order__product_acc">
                        <div class="img-container">
                            <img src="img/{{$product['img_path']}}">
                        </div>
                        <div class="order__product-desc">
                            <p class="order__product-desc-title">{{$product['title']}}</p>
                            <p class="smaller-txt">{{$product['auther_name']}}</p>
                        </div>
                        <div class="order__product-price">
                            <p class="bigger-txt">{{$product['price']}} p.</p>
                            <div class="sale">
                                <p>-{{$order['sale'] * $product['price'] / 100}} р.</p>
                            </div>
                        </div>
                    </div>
            @endforeach
            </div>
        @endforeach
    </div>
</div>


