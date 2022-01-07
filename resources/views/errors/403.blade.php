@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">
    <div class="row">

        @include('includes.sidebar')

        <main class="col py-3 px-4">
            <div class="card p-5">

            	<i class="bi bi-x-circle text-center" style="font-size: 3rem;"></i>

               	<h3 class="text-center">«Lo siento, no tienes permisos para acceder a esta página»</h3>

            </div>
        </main>
    </div>
</div>
@endsection