@extends('layouts.booking')

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

                <div class="row justify-content-center">
                    <div class="col-md-11">
                        <div class="card">
                            <div class="card-header">
                                <h5>
                                    <strong class="float-left">
                                        {{ __('Checkout') }}
                                    </strong>
                                    <strong class="float-right">
                                        <small>
                                            {{ ucfirst(Carbon\Carbon::now()->isoFormat('MM/DD/Y')) }}
                                        </small>
                                    </strong>
                                </h5>
                            </div>
                            <div class="card-body">
                                {!! Form::open(['route' => 'bookings.store']) !!}
                                
                                    @include('bookings.partials.createForm')

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</div>

@endsection