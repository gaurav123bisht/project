@extends('layouts.app')

@section('style')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<style>
th
{
	text-align:center;
	font-size:20px;
}

</style>
@endsection

@section('content')
<div class="container">
<h2>Type Below To Add Record..............................</h2>
	<div class="form-group row add">
			<div class="col-md-5">
				<input type="text" class="form-control" id="title" name="title"
					placeholder="Enter a title" required>
				<p class="error text-center alert alert-danger hidden"></p>
			</div>
			<div class="col-md-5">
				<input type="text" class="form-control" id="description" name="description"
					placeholder="Enter some Description" required>
				<p class="error text-center alert alert-danger hidden"></p>
			</div>
			<div class="col-md-2">
				<button class="btn btn-primary" type="submit" id="add">
					<span class="glyphicon glyphicon-plus"></span> ADD
				</button>
			</div>
		</div>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		
		<div class="table-responsive text-center">
			<table class="table table-borderless" id="table">
				<thead>
					<tr>
						<th>Id</th>
						<th>Title</th>
						<th>Description</th>
						<th >Actions</th>
					</tr>
				</thead>
				<tbody>
				@foreach($data as $posts)	
					<tr class="item{{$posts->id}}">
						<td>{{$posts->id}}</td>
						<td>{{$posts->title}}</td>
						<td>{{$posts->description}}</td>
						<td><button class="edit-modal btn btn-info" data-id="{{$posts->id}}"
								data-title="{{$posts->title}}" data-description="{{$posts->description}}">
								<span class="glyphicon glyphicon-edit"></span> Edit
							</button>
							<button class="delete-modal btn btn-danger" data-id="{{$posts->id}}" data-title="{{$posts->title}}" data-description="{{$posts->description}}">
								<span class="glyphicon glyphicon-trash"></span> Delete
							</button>
						</td>
				</tr>
				@endforeach	
				</tbody>
			</table>
		
</div>
		<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" role="form">
						<div class="form-group">
							<label class="control-label col-sm-2" for="id">ID:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="fid" disabled>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="title">Title:</label>
							<div class="col-sm-10">
								<input type="title" class="form-control" id="n">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="description">Description:</label>
							<div class="col-sm-10">
								<input type="description" class="form-control" id="d">
							</div>
						</div>
					</form>
					<div class="deleteContent">
						Are you Sure you want to delete <span class="dname"></span> ? <span
							class="hidden did"></span>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn actionBtn" data-dismiss="modal">
							<span id="footer_action_button" class='glyphicon'> </span>
						</button>
						<button type="button" class="btn btn-warning" data-dismiss="modal">
							<span class='glyphicon glyphicon-remove'></span> Close
						</button>
					</div>
				</div>
			</div>
		</div>
		</div>
</div>
	
@endsection

@push('script')

<script>
    $(document).on('click', '.edit-modal', function() {
        $('#footer_action_button').text(" Update");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').addClass('edit');
        $('.actionBtn').removeClass('delete');
        $('.modal-title').text('Edit');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        $('#fid').val($(this).data('id'));
        $('#n').val($(this).data('title'));
        $('#d').val($(this).data('description'));
        $('#myModal').modal('show');
    });
    $(document).on('click', '.delete-modal', function() {
        $('#footer_action_button').text(" Delete");
        $('#footer_action_button').removeClass('glyphicon-check');
        $('#footer_action_button').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').addClass('delete');
        $('.actionBtn').removeClass('edit');
        $('.modal-title').text('Delete');
        $('.did').text($(this).data('id'));
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        $('.dname').html($(this).data('name'));
        $('#myModal').modal('show');
    });

    $('.modal-footer').on('click', '.edit', function() {

        $.ajax({
            type: 'post',
            url: '/editItem',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'name': $('#n').val(),
                'description':$('#d').val()
            },
            success: function(data) {
                $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.title +"</td><td>"+data.description+"</td><td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-title='" + data.title +"'data-description='"+data.description+ "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-title='" + data.title +"'data-description='"+ data.description+"' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
            }
        });
    });
    $("#add").click(function() {
        $.ajax({
            type: 'post',
            url: '/addItem',
            data: {
                '_token': $('input[name=_token]').val(),
                'title': $('input[name=title]').val(),
                'description':$('input[name=description]').val()
            },
            success: function(data) {

                if ((data.errors))
                {
                	$('.error').removeClass('hidden');
                    $('.error').text(data.errors.title);
                    $('.error').text(data.errors.description);
                }
                else 
                {
                    $('.error').addClass('hidden');
                    $('#table').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.title +"</td><td>"+ data.description+"</td><td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-title='" + data.title +"'data-description='"+data.description + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-title='" + data.title +"'data-description='"+data.description+ "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
                }
                $('#title').val('');
                $('#description').val('');
            },
        });
        
    });
    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'post',
            url: '/deleteItem',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.did').text()
            },
            success: function(data) {
                $('.item' + $('.did').text()).remove();
            }
        });
    });
</script>

@endpush