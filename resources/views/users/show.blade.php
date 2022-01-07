@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">
    <div class="row">

        @include('includes.sidebar')

        <main class="col py-3 px-4">

            <div class="card p-5">

                @role('Super')
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">{{ __('Users') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('User detail') }}</li>
                        </ol>
                    </nav>
                @endrole

                @role('User')
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"></li>
                        </ol>
                    </nav>
                @endrole

                {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT']) !!}

                    <div class="form-group row">
                        <div class="col-md-6 mb-3 mb-md-0">
                            {{ Form::label('first_name', 'First name', ['class' => 'mb-0']) }}
                            {{ Form::text('first_name', null, ['class' => 'form-control', 'id' => 'first_name', 'readonly']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('last_name', 'Last name', ['class' => 'mb-0']) }}
                            {{ Form::text('last_name', null, ['class' => 'form-control', 'id' => 'last_name', 'readonly']) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 mb-3 mb-md-0">
                            {{ Form::label('email', 'E-mail', ['class' => 'mb-0']) }}
                            {{ Form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'readonly']) }}

                        </div>
                        <div class="col-md-6">
                            {{ Form::label('phone', 'Phone', ['class' => 'mb-0']) }}
                            {{ Form::text('phone', null, ['class' => 'form-control', 'id' => 'phone', 'readonly']) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12 mb-3 mb-md-0">
                            {{ Form::label('address', 'Address', ['class' => 'mb-0']) }}
                            {{ Form::text('address', null, ['class' => 'form-control', 'id' => 'address', 'readonly']) }}

                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 mb-3 mb-md-0">
                            {{ Form::label('city', 'City', ['class' => 'mb-0']) }}
                            {{ Form::text('city', null, ['class' => 'form-control', 'id' => 'city', 'readonly']) }}

                        </div>
                        <div class="col-md-6">
                            {{ Form::label('zipcode', 'Zipcode', ['class' => 'mb-0']) }}
                            {{ Form::text('zipcode', null, ['class' => 'form-control', 'id' => 'zipcode', 'readonly']) }}
                        </div>
                    </div>

                    @if($user->company_name != NULL && $user->company_website)

                        <div class="form-group row">
                            <div class="col-md-6 mb-3 mb-md-0">
                                {{ Form::label('company_name', 'Company name', ['class' => 'mb-0']) }}
                                {{ Form::text('company_name', null, ['class' => 'form-control', 'id' => 'company_name', 'readonly']) }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('company_website', 'Company website', ['class' => 'mb-0']) }}
                                {{ Form::text('company_website', null, ['class' => 'form-control', 'id' => 'company_website', 'readonly']) }}
                            </div>
                        </div>
                    @endif

                {!! Form::close() !!}

            </div>
            
        </main>

    </div>
</div>
@endsection
