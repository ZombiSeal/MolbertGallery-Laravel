
        @foreach($products as $product)
            @if(session()->has('basket') && in_array($product->id_product, session()->get('basket')))
                <x-card :product="$product" disabled="disabled" text="В корзине"></x-card>
            @else
                <x-card :product="$product"></x-card>
            @endif
        @endforeach

