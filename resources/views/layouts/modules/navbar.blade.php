<nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color: #b3e8ca">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
{{--            Практика по БД )--}}
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <div class="nav-item btn mt-0 dropdown-toggle text-black-50" type="button" id="dropdownMenuButton"
                         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Справочники
                    </div>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{route('currencies.index')}}">Валюты</a>
                        <a class="dropdown-item" href="{{route('cities.index')}}">Города</a>
                        <a class="dropdown-item" href="{{route('banks.index')}}">Банки</a>
                        <a class="dropdown-item" href="{{route('exchange-offices.index')}}">Пункты обмена валют</a>
                    </div>
                    @if (auth()->check())
                        <a class="nav-item btn mt-0 text-black-50" href="{{route('users.currency-balances.index', auth()->user())}}">Счета</a>
                        <a class="nav-item btn mt-0 text-black-50" href="{{route('ex-cur.select-action')}}">Обменять валюту</a>

                    @endif

                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Авторизация') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->getName() }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Выйти') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
