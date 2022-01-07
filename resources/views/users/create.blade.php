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
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Users') }}</li>
                    </ol>
                </nav>

                <div class="card p-3">

                    <div class="card-body">
                        {!! Form::open(['route' => 'users.store']) !!}
                                    
                            @include('users.partials.createForm')

                            <div class="form-group row mb-0">
                                <div class="form-group col-md-12 col-sm-12 text-left">
                                    {{ Form::submit(trans('Register'), ['class' => 'btn btn-primary btn-block']) }}
                                </div>
                            </div>

                        {!! Form::close() !!}
                    </div>
                    
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
