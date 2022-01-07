@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">
    <div class="row">

        @include('includes.sidebar')

        <main class="col py-3 px-4">
            <div class="card p-5">

                @if(!empty($info))
                  <div class="alert alert-success"> {{ $info }}</div>
                @endif

                <div class="container">
                    @if (isset($errors) && $errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            <ul>
                                @foreach (session()->get('success') as $message)
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Edit user') }}</li>
                    </ol>
                </nav>

                <div class="card p-3">

                {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT', 'files' => true]) !!}

                    <div class="form-group row">
                        <div class="col-md-6 mb-3 mb-md-0">

                            {{ Form::text('first_name', null, ['class' => 'form-control', 'id' => 'first_name', 'placeholder' => trans('First name'), 'required' => 'required']) }}

                        </div>
                        <div class="col-md-6">

                            {{ Form::text('last_name', null, ['class' => 'form-control', 'id' => 'last_name', 'placeholder' => trans('Last name'), 'required' => 'required']) }}

                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">

                            {{ Form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'readonly']) }}

                        </div>
                        <div class="col-md-6 mb-3 mb-md-0">

                            {{ Form::text('phone', null, ['class' => 'form-control', 'id' => 'phone', 'placeholder' => trans('Phone'), 'required' => 'required']) }}

                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">

                            {{ Form::text('address', null, ['class' => 'form-control', 'id' => 'address', 'required' => 'required' ]) }}

                        </div>

                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 mb-3 mb-md-0">

                            {{ Form::text('city', null, ['class' => 'form-control', 'id' => 'city', 'placeholder' => trans('City'), 'required' => 'required']) }}

                        </div>
                        <div class="col-md-6 mb-3 mb-md-0">

                            {{ Form::text('zipcode', null, ['class' => 'form-control', 'id' => 'zipcode', 'placeholder' => trans('Zipcode'), 'required' => 'required']) }}

                        </div>
                    </div>

                    @role('User')
                        <div class="form-group row">
                            <div class="col-md-6 mb-3 mb-md-0">

                                {{ Form::text('company_name', null, ['class' => 'form-control', 'id' => 'company_name', 'placeholder' => trans('Company')]) }}

                            </div>
                            <div class="col-md-6 mb-3 mb-md-0">

                                {{ Form::text('company_website', null, ['class' => 'form-control', 'id' => 'company_website', 'placeholder' => trans('Address')]) }}

                            </div>
                        </div>
                    @endrole

                    <div class="form-group row">
                        <div class="col-md-6 mb-3 mb-md-0">

                            {{ Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => trans('Password')]) }}

                        </div>

                        <div class="col-md-6">

                            {{ Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password-confirm', 'placeholder' => trans('Confirm Password')]) }}

                        </div>
                    </div>

                    <div>
                        <input type="hidden" name="user_type" value="User">
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary w-100">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </div>

                {!! Form::close() !!}
                </div>
            </div>
        </main>

    </div>
</div>
@endsection
