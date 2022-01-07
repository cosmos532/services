@extends('layouts.login')
@section('title', 'Account Inactive')
@section('content')

	<div class="col-lg-6 mx-auto alert alert-danger" role="alert">
		<h4 class="alert-heading">{{ __('This profile is inactive') }}</h4>
		<p>Is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
		<hr>
		<div class="row justify-content-center">
	  		<p class="mb-0"><a href="{{ route('index') }}"><i class="text-primary fas fa-home"></i> {{ __('Go to home') }}</a></p>
	  	</div>
	</div>

@endsection