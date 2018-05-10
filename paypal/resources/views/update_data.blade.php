@extends('master')
@section('content')
<div class="container">

		<div class="col-md-2">
		</div>
	<form method="POST" action="{{route('update')}}">
		<div class="col-md-8 form-group" style="border:2px solid teal;border-radius: 10px;">
		{{csrf_field()}}
		<center><h1>Update Record.....................</h1></center>
		<input type="hidden" value="{{$data->id}}" name="id">
	
					<div class="row">		
					<div class="col-md-6">
					
					<label>User Name</label>
					</div>

					<div class="col-md-6">
					<input type="text" name="name" value="<?php echo isset($data->name)?$data->name:" ";?>" class="form-control" autofocus>
					</div>
					</div><br><br><br>
		
					<div class="row">
						<div class="col-md-6">
					<label>User Email-ID</label>
					</div>
					<div class="col-md-6">
					<input type="text" name="email" value="<?php echo isset($data->email)?$data->email:" ";?>" class="form-control" >
					</div><br><br><br>
					</div>

		
					<div class="row">
						

						<div class="col-md-6 form-control ">
					 <button type="submit"  class="form-control btn btn-info">Update
						</button>
						</div>

						
						
					</div><br>

		</div>
</form>
		<div class="col-md-2">
		</div>
	
</div>
@endsection
