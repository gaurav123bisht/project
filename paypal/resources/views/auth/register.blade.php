@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                    <div class="form-group">
                            <label for="state" class="col-md-4 control-label">Choose State</label>
                        <div class="col-md-6">
                            <select class="form-control" name="state" id="state">
                           
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                            <label for="district" class="col-md-4 control-label">Choose District</label>
                        <div class="col-md-6">
                            <select class="form-control" name="district" id="district">
                           
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                            <label for="city" class="col-md-4 control-label">Choose City</label>
                        <div class="col-md-6">
                            <select class="form-control" name="city" id="city">
                           
                            </select>
                        </div>
                    </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script type="text/javascript">

function myFunction() 
{
   $.ajax({
        type: "get",
        url: '/getState',
    
        success: function(data) 
        {
           // console.log(data);
                if(data[0].name)
                {
                   
                    $("#state").empty();
                     $("#state").append('<option>Select State</option>');
                      $.each(data,function(key,value)
                     {
                        $("#state").append('<option value="'+value.id+'">'+value.name+'</option>');
                     });
                }
        }
        
    });
}
$(document).ready(function(){
    $('#state').change(function(){
        $.ajax({
            type:"post",
            url:'/getDistrict',
            data:{
                  '_token': $('input[name=_token]').val(),
                'state_id': $("#state").val()
            },
            success:function(data)
            {
                $("#district").empty();
                $("#district").append('<option>Select District</option>');
                $.each(data,function(key,value)
                {
                    $("#district").append('<option value="'+value.id+'">'+value.name+'</option>');
                });
            }
        });
    });
});
$(document).ready(function(){
    $('#district').change(function(){
        $.ajax({
            type:"post",
            url:'/getCity',
            data:{
                  '_token': $('input[name=_token]').val(),
                'district_id': $("#district").val()
            },
            success:function(data)
            {
                $("#city").empty();
                $("#city").append('<option>Select Your City</option>');
                $.each(data,function(key,value)
                {
                    $("#city").append('<option value="'+value.id+'">'+value.name+'</option>');
                });
            }
        });
    });
});
</script>
@endpush

