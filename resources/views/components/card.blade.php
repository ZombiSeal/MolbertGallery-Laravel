<div class="card" data-id="{{$product->id_product}}">
    <div class="card__img">
        <div class="card__img-container">
            <img src="img/{{$product->img_path}}">
        </div>
    </div>
    <div class="card__desc">
        <p class="card__auth">{{$product->author->auther_name}}</p>
        <p class="card__title">"{{$product->title}}"</p>
        <div class="card__desc-price">
            @if($product->amount && Auth::user())
                <p class="card__price bigger-txt">{{$product->price}} р.</p>
                <button class="btn-icon btn-icon_buy buy" data-id="{{$product->id_product}}" {{$disabled}}>{{$text}}</button>
            @elseif($product->amount && !Auth::user())
                <p class="card__price bigger-txt">{{$product->price}} р.</p>
                <a class="btn-icon btn-icon_buy" href="{{route('login')}}"></a>
            @else
                <p class="card__price">продано ({{$product->price}} р.)</p>
            @endif
        </div>
    </div>
</div>

