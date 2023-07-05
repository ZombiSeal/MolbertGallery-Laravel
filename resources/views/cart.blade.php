@extends('main')
@section('content')
    @csrf
    <section class="basket">
        <h1 class="title">Корзина</h1>
        <div class="basket__wrapper">

            @if(session()->has("basket"))
            <div class="table-container">
                    <table class="basket__table table">
                        <thead class="table__header">
                        <th>Товар</th>
                        <th>Размер</th>
                        <th>Цена</th>
                        <th></th>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <x-cart-row :product="$product"></x-cart-row>
                        @endforeach

                        </tbody>
                    </table>
            </div>
                <div class="total-price">
                    <h2>Ваш заказ</h2>
                    <div class="total-price__txt">
                        <p class="total-price__subtitle">Итого к оплате</p>
                        <p class="total-price__val bigger-txt">{{$totalPrice}} р.</p>
                    </div>
                </div>
                <div class="basket__btn">
                    <a href="{{route('catalog')}}" class="basket__btn-link btn-white">Вернуться к покупкам</a>
                    <a href="{{route('order')}}" class="basket__btn-link btn">Оформить заказ</a>
                </div>
            @else
                <p>Корзина пустая</p>
            @endif
        </div>
    </section>
@endsection
