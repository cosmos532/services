@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">
    <div class="row">

        @include('includes.sidebar')

        <main class="col py-3 px-4">

            @role('Super|Admin')
                <h1 class="h2">{{ __('Dashboard') }}</h1>

                <div class="row my-4">
                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                        <div class="card">
                            <h5 class="card-header"><i class="bi bi-people" style="font-size: 1.2rem;"></i> {{ __('Users') }}</h5>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('users.index') }}"><div class="d-flex justify-content-center">{{ $users->count() -1 ?? '' }}</div></a>
                                </h5>
                            </div>
                        </div>
                    </div>

                <div class="col-12 text-right">
                    <strong>{{ __('Last login:') }}</strong> {{ Auth::user()->last_login }}
                </div>
            @endrole

            @role('User')
                <div class="container h-100">
                    <div class="d-flex h-100 text-center align-items-center">
                        <div class="w-100">
                            <h1>{{ __('Hello') }} {{ Auth::user()->first_name }}, {{ __('Welcome back!') }}</h1>
                            <strong>{{ __('Last login:') }}</strong> {{ Auth::user()->last_login }}
                        </div>
                    </div>
                </div>
            @endrole
        </main>

    </div>
</div>
@endsection
