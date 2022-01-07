<nav id="navbar" class="navbar navbar-expand-md navbar-light bg-white shadow-sm border-bottom fixed-top">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#app"><img class="img-fluid" src=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->

            <ul class="navbar-nav mr-auto">
                <li class="nav-item mx-0 mx-lg-1 mx-md-2">
                    <a class="nav-link py-2 px-0 px-lg-2 rounded js-scroll-trigger" aria-current="page" href="#" data-toggle="modal" data-target="#aboutModal"><h5>{{ __('About us') }}</h5></a>
                </li>
                <li class="nav-item mx-0 mx-lg-1 mx-md-2"><a class="nav-link py-2 px-0 px-lg-2 rounded js-scroll-trigger" href="#services"><h5>{{ __('Services') }}</h5></a></li>
                <li class="nav-item mx-0 mx-lg-1 mx-md-2">
                    <a class="nav-link py-2 px-0 px-lg-2 rounded js-scroll-trigger" aria-current="page" href="#" data-toggle="modal" data-target="#ratesModal"><h5>{{ __('Rates') }}</h5></a>
                </li>
                <li class="nav-item mx-0 mx-lg-1 mx-md-2"><a class="nav-link py-2 px-0 px-lg-2 rounded js-scroll-trigger" href="#reviews"><h5>{{ __('Reviews') }}</h5></a></li>
                <li class="nav-item mx-0 mx-lg-1 mx-md-2"><a class="nav-link py-2 px-0 px-lg-2 rounded js-scroll-trigger" href="#faq"><h5>{{ __("Faq") }}</h5></a></li>
                <li class="nav-item mx-0 mx-lg-1 mx-md-2"><a class="nav-link py-2 px-0 px-lg-2 rounded js-scroll-trigger" href="#contact"><h5>{{ __("Contact") }}</h5></a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Language -->
                @if (config('locale.status') && count(config('locale.languages')) > 1)
                    <div class="top-right links me-3">
                        @foreach (array_keys(config('locale.languages')) as $lang)
                            @if ($lang != App::getLocale())
                                <table>
                                  <tbody>
                                    <tr>
                                      <td class="align-middle">
                                        <a href="{!! route('lang.swap', $lang) !!}">
                                            @if($lang == 'en')
                                                <img src="{{ asset('media/en.png') }}">
                                            @elseif($lang == 'es')
                                                <img src="{{ asset('media/es.png') }}">
                                            @endif
                                        </a>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                            @endif
                        @endforeach
                    </div>
                @endif
                
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <h5><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</h5></a>
                    </li>
                    <li class="nav-item">
                        <h5><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</h5></a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->first_name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('home') }}">
                                {{ __('Dashboard') }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>