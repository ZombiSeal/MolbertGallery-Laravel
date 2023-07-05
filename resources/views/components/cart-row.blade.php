<tr>
    <td>
        <div class="table__product">
            <div class="table__img-container">
                <img src="img/{{$product->img_path}}">
            </div>
            <div class="table__product-desc">
                <p class="table__product-title">{{$product->title}}</p>
                <p class="table__product-auther">{{$product->author->auther_name}}</p>
            </div>
        </div>
    </td>
    <td>
        <p class="table__size">{{$product->size->width}} x {{$product->size->height}} см</p>
    </td>
    <td class="table__price">{{$product->price}}</td>
    <td>
        <button class="table__close btn-table" data-id="{{$product->id_product}}"></button>
    </td>
</tr>
