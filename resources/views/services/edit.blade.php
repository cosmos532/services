@extends('layouts.invoice')

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
                        <li class="breadcrumb-item"><a href="{{ route('services.index') }}">{{ __('Services') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Edit service') }}</li>
                    </ol>
                </nav>

                <div class="card p-3">
                    
                    {!! Form::model($service, ['route' => ['services.update', $service->id], 'method' => 'PUT']) !!}

                        <div class="table mt-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('Name') }}</th>
                                                    <th>{{ __('Description') }}</th>
                                                    <th>{{ __('Price') }}</th>
                                                    <th>{{ __('Type') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input class="form-control" type="text" name="name" value="{{ $service->name }}">
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" name="description" value="{{ $service->description }}">
                                                    </td>
                                                    <td>
                                                        <select class="form-control" name="type" id="type">
                                                            <option value="{{ $service->type }}" selected>
                                                                @if($service->type == 0)
                                                                    {{ __('Check price') }}
                                                                @else($service->type == 1)
                                                                    {{ __('Fixed price') }}
                                                                @endif
                                                            </option>
                                                            @if($service->type == 0)
                                                                <option value="1">{{ __('Fixed price') }}</option>
                                                            @elseif($service->type == 1)
                                                                <option value="0">{{ __('Check price') }}</option>
                                                            @endif
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" name="price" id="price" value="{{ $service->price }}">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-4 text-center"><button class="btn btn-success">{{ __('Update service') }}</button></div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    $(document).ready(function(){
        value = $("#type").val();
        
        if (value === "0") {
            document.getElementById('price').value = '';
            $("#price").prop("disabled", true);
        }
        if (value === "1") {
            $("#price").prop("disabled", false);
        }
    });
</script>

<script>
    $("#price").change( function() {
        $(this).val(function (i, v) {
            return parseFloat(v).toFixed(2);
        })
    });
</script>

<script>
    $( function() {
        $("#type").change( function() {
            if ($(this).val() === "0") {
                document.getElementById('price').value = '';
                $("#price").prop("disabled", true);
            }
            if ($(this).val() === "1") {
                $("#price").prop("disabled", false);
            }
        });
    });
</script>

@endsection