<div class="order__product">
    <div class="img-container">
        <img src="img/{{$product->img_path}}">
    </div>
    <div class="order__product-desc">
        <p class="order__product-desc-title">{{$product->title}}</p>
        <p class="smaller-txt">{{$product->author->auther_name}}</p>
        <div class="order__product-desc-size">
            <p>Размер</p>
            <p>{{$product->size->width}} x {{$product->size->height}}</p>
        </div>
    </div>
    <div class="order__product-price">
        <p class="bigger-txt">{{$product->price}} p.</p>
    </div>
</div>
