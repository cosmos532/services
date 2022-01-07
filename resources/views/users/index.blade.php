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

                    @if ($users->isEmpty())

                        <div class="d-flex justify-content-between">
                            @role('Super')
                                <div class="col-md-6 col-sm-12">
                                    <a class="btn btn-primary mr-2" href="{{ route('users.create') }}" role="button"><i class="fas fa-plus-circle"></i> {{ __('New user') }}</a>
                                </div>
                            @endrole

                            <div class="col-md-6 col-sm-12">
                                <form method="get" action="{{ route('users.search')}}" class="form-inline pb-4">
                                    <input class="form-control mr-sm-2 col-lg-9 col-md-10" type="search" name="user" placeholder="Search by User/Role/E-mail" aria-label="Search">
                                    <button class="btn btn-primary my-sm-2" type="submit">{{ __('Search') }}</button>
                                </form>
                            </div>
                        </div>

                        <div class="text-center">
                            <h5>No se encontraron usuarios</h5>
                        </div>

                    @else

                        <div class="d-flex justify-content-between">
                            @role('Super')
                                <div class="col-md-6 col-sm-12">
                                    <a class="btn btn-primary mr-2" href="{{ route('users.create') }}" role="button"><i class="fas fa-plus-circle"></i> {{ __('New user') }}</a>
                                </div>
                            @endrole

                            <div class="col-md-6 col-sm-12">
                                <form method="get" action="{{ route('users.search')}}" class="form-inline pb-4">
                                    <input class="form-control mr-sm-2 col-lg-9 col-md-10" type="search" name="user" placeholder="Search by User/Role/E-mail" aria-label="Search">
                                    <button class="btn btn-primary my-sm-2" type="submit">{{ __('Search') }}</button>
                                </form>
                            </div>
                        </div>

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="row">{{ __('User') }}</th>
                                    <th scope="row">{{ __('Role') }}</th>
                                    <th scope="row">{{ __('E-mail') }}</th>
                                    <th scope="row">{{ __('Status') }}</th>
                                    <th scope="row">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td scope="row">{{ $user->first_name }} {{ $user->last_name }}</td>
                                    <td scope="row">{{ $user->user_type }}</td>
                                    <td scope="row">{{ $user->email }}</td>
                                    <td>
                                        @if ($user->status == 'ACTIVE')
                                            <spam title="El usuario está activo"> {{ __('Active') }}</spam>
                                        @elseif ($user->status == 'INACTIVE')
                                            <spam title="El usuario está suspendido">{{ __('Inactive') }}</spam>
                                        @endif
                                    </td>
                                    <td scope="row">
                                        <div class="row">
                                            <a href="{{ route('users.show', $user->id) }}" type="submit" class="btn btn-sm btn-primary mb-1 mr-1">{{ __('View') }}</a>
                                            @role('Super')
                                                @if ($user->user_type == 'Admin')
                                                    <a href="{{ route('users.edit', $user->id) }}" type="submit" class="btn btn-sm btn-success mb-1 mr-1">{{ __('Edit') }}</a>
                                                @endif
                                                @if ($user->status == 'ACTIVE')
                                                    {!! Form::open(['route' => 'users.status']) !!}
                                                    {{ Form::hidden('status', 'INACTIVE') }}
                                                    {{ Form::hidden('id', $user->id) }}
                                                    <button type="submit" class="btn btn-sm btn-secondary mr-2" onclick="return confirm('¿Confirma que quieres deshabilitar a este usuario?');">{{ __('Disable') }}</button>
                                                    {!! Form::close() !!}
                                                @elseif ($user->status == 'INACTIVE')
                                                    {!! Form::open(['route' => 'users.status']) !!}
                                                    {{ Form::hidden('status', 'ACTIVE') }}
                                                    {{ Form::hidden('id', $user->id) }}
                                                    <button type="submit" class="btn btn-sm btn-info text-light mr-2">{{ __('Enable') }}</button>
                                                    {!! Form::close() !!}
                                                @endif
                                            @endrole
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>   
                        </table>

                        <div class="row">
                            <div class="pagination-sm mx-auto">
                                {{ $users->appends(request()->input())->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
</div>
@endsection