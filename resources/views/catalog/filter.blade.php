<div class="catalog__filter filter">
    <form action="{{route('filter')}}" method="post" class="filter__form">
        @csrf
        <button class="reset">Сбросить все</button>

        <x-filter-item title="Категории" :items="$categories" name="category[]" type="category"></x-filter-item>
        <x-filter-item title="Стили" :items="$styles" name="style[]" type="style"></x-filter-item>
        <x-filter-item title="Техники" :items="$materials" name="material[]" type="material"></x-filter-item>

        <div class="filter__item">
            <h2 class="filter__title">Цена</h2>
            <div class="filter__price">
                <input class="price-from" name="priceFrom" type="text" placeholder="от">
                <input class="price-to" name="priceTo" type="text" placeholder="до">
            </div>
        </div>
        <button class="btn-second btn_catalog">ОК</button>

    </form>
</div>
