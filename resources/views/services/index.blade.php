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
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Services') }}</li>
                    </ol>
                </nav>

                <div class="card p-3">

                    @if ($services->isEmpty())

                        <div class="text-center">
                            <h5>No se encontraron servicios</h5>
                        </div>

                    @else

                        @role('Super')
                            <div class="text-right pt-2 pb-3">
                                <a class="btn btn-primary" href="{{ route('services.create') }}" role="button"><i class="fas fa-plus-circle"></i> {{ __('Make a new service') }}</a>
                            </div>
                        @endrole

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Price') }}</th>
                                    <th>{{ __('Type') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($services as $service)
                                    <tr>
                                        <td>{{ $service->name }}</td>
                                        <td>{{ $service->description }}</td>
                                        <td>
                                            @if($service->type == 0)
                                                {{ __('To consult') }}
                                            @else($service->type == 1)
                                                {{ $service->price }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($service->type == 0)
                                                {{ __('Check price') }}
                                            @else($service->type == 1)
                                                {{ __('Fixed price') }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('services.edit', $service->id) }}" type="submit" class="btn btn-sm btn-success mb-1 mr-1">{{ __('Edit') }}</a>
                                            <a href="{{ route('services.destroy', $service->id) }}" type="submit" class="btn btn-sm btn-danger mb-1 mr-1">{{ __('Delete') }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="row">
                            <div class="pagination-sm mx-auto">
                                {{ $services->appends(request()->input())->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
</div>
@endsection