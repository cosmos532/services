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
        {{ Form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => trans('E-mail'), 'required' => 'required']) }}
    </div>
    <div class="col-md-6 mb-3 mb-md-0">
        {{ Form::text('phone', null, ['class' => 'form-control', 'id' => 'phone', 'placeholder' => trans('Phone'), 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    <div class="col-md-12">
        {{ Form::text('address', null, ['class' => 'form-control', 'id' => 'address', 'placeholder' => trans('Address'), 'required' => 'required']) }}
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

<div class="form-group row">
    <div class="col-md-6 mb-3 mb-md-0">
        {{ Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => trans('Password')]) }}
    </div>

    <div class="col-md-6">
        {{ Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password-confirm', 'placeholder' => trans('Confirm Password')]) }}
    </div>
</div>

<div>
    <input type="hidden" name="user_type" value="Admin">
    <input id="status" type="hidden" name="status" value="ACTIVE">
</div>