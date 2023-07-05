<div class="user-account__block">
    <h2>Личные данные</h2>
    <form action="{{route('account.data.editUser')}}" method="post" class="user-account__form-data form-inf" name="inf">
        @csrf
        <div class="form-inf__item">
            <label for="inf-firstname">Имя {{Auth::user()->firstname}}</label>
            <input id="inf-firstname" class="input edit firstname" type="text" name="firstname" placeholder="Введите имя" value="{{Auth::user()->firstname}}">
            <span class="firstName__error error"></span>
        </div>
        <div class="form-inf__item">
            <label for="inf-lastname">Фамилия</label>
            <input id="inf-lastname" class="input edit lastname" type="text" name="lastname" placeholder="Введите фамилию" value="{{Auth::user()->lastname}}">
            <span class="lastName__error error"></span>
        </div>
        <div class="form-inf__item">
            <label for="inf-email">E-mail</label>
            <input id="inf-email" class="input edit email" type="text" name="email" placeholder="Введите e-mail" value="{{Auth::user()->email}}">
            <span class="email__error emailExist__error  error"></span>
        </div>
        <input type="submit" class="btn user-account__btn" value="Изменить">
    </form>
</div>
<div class="user-account__block">
    <h2>Смена пароля</h2>
    <form action="{{route('account.data.editPassword')}}" method="post" class="user-account__form-pass form-inf" name="inf">
        @csrf
        <div class="form-inf__item">
            <label for="inf-user-pass">Ваш текущий пароль</label>
            <input id="inf-user-pass" class="input user-password" type="password" name="user-password" placeholder="Введите ваш пароль">
            <span class="userPassword__error error"></span>
        </div><div class="form-inf__item">
            <label for="inf-password">Новый пароль</label>
            <input id="inf-password" class="input edit password" type="password" name="password" placeholder="Введите новый пароль">
            <span class="password__error error"></span>
        </div>
        <div class="form-inf__item">
            <label for="inf-pass-repeat">Повторите новый пароль</label>
            <input id="inf-pass-repeat" class="input repeat-password" type="password" name="passwordRepeat" placeholder="Повторите пароль">
            <span class="passwordRepeat__error error"></span>
        </div>
        <input type="submit" class="btn user-account__btn" value="Изменить">
    </form>
</div>

