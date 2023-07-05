@extends('main')
@section('content')
    @csrf
        <section class="user-account">
            <h1 class="title">Мой аккаунт</h1>
            <div class="user-account__body">
                <nav class="user-account__nav">
                    <ul class="user-account__list">
                        <li class="user-account__item"><a href="{{route('account.data')}}" data-href="data" class="user-account__link user-account__link_data user-account__link_active">Даные аккаунта</a></li>
                        <li class="user-account__item"><a href="{{route('account.order')}}" data-href="order" class="user-account__link user-account__link_order">Мои заказы</a></li>
                        <li class="user-account__item"><a href="{{route('logout')}}" data-href="exit"   data-page="exit" class="user-account__link user-account__link_exit">Выйти</a></li>
                    </ul>
                </nav>
                <div class="user-account__info">
                    @include("account.data")
                </div>
            </div>
        </section>
@endsection
