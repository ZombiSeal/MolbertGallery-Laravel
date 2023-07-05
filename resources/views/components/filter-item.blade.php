<div class="filter__item">
    <h2 class="filter__title">{{$title}}</h2>
    <div class="{{$type}} filter__body">
        @foreach($items as $item)
            <x-checkbox :name="$name" :item="$item" :type="$type"></x-checkbox>
        @endforeach
    </div>
</div>
