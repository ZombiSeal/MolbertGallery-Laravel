@extends('main')
@section('content')
    <section class="catalog">
        <div class="catalog__header">
            <h1 class="title">Каталог</h1>
        </div>

        <div class="catalog__body">
            @include('catalog.filter')
            <div class="catalog__products">
            @include('catalog.products')
            </div>
        </div>
    </section>
@endsection
