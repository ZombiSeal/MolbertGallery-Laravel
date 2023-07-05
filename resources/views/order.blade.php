@extends('main')
@section('content')
    <section class="order">
        @csrf
        <h1 class="title">Оформление заказа</h1>
        <div class="order__container">
            <div class="order__col">
                <form class="delivery order__form">
                    <h2 class="order__form-title">Способ доставки</h2>
                    <div class="delivery__form order__form-item delivery__error valid">
                        @foreach($deliveries as $delivery)
                            <x-radiobutton name="delivery" :item="$delivery"></x-radiobutton>
                        @endforeach
                    </div>
                </form>
                <form class="adress order__form">
                    <h2 class="order__form-title">Адрес доставки</h2>
                    <div class="adress__form order__form-item">
                        <p class="adress__form-subtitle">Улица</p>
                        <div class="adress__street">
                            <input class="adress__street-name input street__error valid" name="street" type="text" placeholder="Улица" value="">
                            <input class="adress__street-house input house__error valid" name="house" type="text" placeholder="Дом" value="">
                        </div>

                        <p class="adress__form-subtitle">Город</p>
                        <input class="adress__city input city__error valid" name="city" type="text" placeholder="Город" value="">

                        <p class="adress__form-subtitle">Страна</p>
                        <input class="adress__country input country__error valid" name="country" type="text" placeholder="Страна" value="">
                    </div>
                </form>
                <form class="payment order__form">
                    <h2 class="order__form-title">Способ оплаты</h2>
                    <div class="payment__form order__form-item payment__error valid">
                        @foreach($payments as $payment)
                            <x-radiobutton name="payment" :item="$payment"></x-radiobutton>
                        @endforeach
                    </div>
                </form>

            </div>

            <div class="order__col">
                <div class="order__form">
                    <h2 class="order__form-title">Итого к оплате</h2>

                    <div class="products">
                        @foreach($products as $product)
                            <x-order-product :product="$product"></x-order-product>
                        @endforeach
                    </div>
                    <div class="order__total">
                        <div class="order__total-item">
                            <span>Стоимость</span>
                            <p class="bigger-txt order__total-price">{{$totalPrice}} р.</p>
                        </div>
                        <div class="order__total-item">
                            <span>Скидка</span>
                            <p class="bigger-txt order__sale">0 р.</p>
                        </div>
                        <div class="order__total-item">
                            <span>Всего</span>
                            <p class="bigger-txt order__price-sale">{{$totalPrice}} р.</p>
                        </div>
                    </div>
                </div>

                <form class="sale order__form">
                    <div class="sale__form order__form-item">
                        <p class="sale__form-title">Использовать скидку</p>
                        <input class="sale__form-val input" type="text" name="sale" placeholder="Введите код">
                        <button class="btn-white sale__form-btn">Применить</button>
                    </div>
                </form>

                <div class="order__btn">
                    <a href="{{route('catalog')}}" class="order__btn-link btn-white">Вернуться к покупкам</a>
                    <input type="submit" class="order__btn-link btn order__submit" value="Оформить заказ">
                </div>

            </div>
        </div>

    </section>
@endsection
