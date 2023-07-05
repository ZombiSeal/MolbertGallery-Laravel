<header>
    <div class="container header__container">
        <nav class="nav">
            <ul class="nav__list">
                <li class="nav__item"><a href="#" class="nav__link">Каталог</a></li>
                <li class="nav__item"><a href="#" class="nav__link">Авторы</a></li>
                <li class="nav__item"><a href="#" class="nav__link">О нас</a></li>
                <li class="nav__item"><a href="" class="nav__link">Контакты</a></li>
            </ul>
        </nav>

        <div class="logo">
            <a href="{{route('catalog')}}" class="logo__link"><img src="/img/svg/logo.svg" alt=""></a>
        </div>
        <div class="func">
            <div class="func__container">
                <div class="account func__item">
                    @if(Auth::user())
                        <a href="{{route('account.show')}}" class="account__link"> <img src="/img/svg/account.svg" alt=""></a>
                    @else
                        <a href="{{route('login')}}" class="account__link"> <img src="/img/svg/account.svg" alt=""></a>
                    @endif
                </div>
                <div class="basket func__item">
                    @if(Auth::user())
                        <a href="{{route('cart')}}" class="basket__link"><img src="/img/svg/basket.svg" alt=""></a>
                    @else
                        <a href="{{route('login')}}" class="account__link"> <img src="/img/svg/basket.svg" alt=""></a>
                    @endif
                </div>
            </div>

        </div>
    </div>
</header>
