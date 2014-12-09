@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('user/user.forgot_password') }}} ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
    <h1>{{{ Lang::get('user/user.forgot_password') }}}</h1>
</div>


<form class="form-horizontal" method="POST" action="/account/forgot" accept-charset="UTF-8">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">

  <fieldset>
    <div class="form-group">
        <label class="col-md-2 control-label" for="email">Email</label>
        <div class="col-md-6">
            <input class="form-control" tabindex="1" placeholder="Email" type="text" name="email" id="email" value="{{ Input::old('email') }}">
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <button tabindex="3" type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
	</fieldset>

    
</form>


@stop
