<!DOCTYPE html>
<html>
<head>
    <title>AJAX|CRUD Example</title>
</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script
    src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script
    src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<body>

<!--................................ VIEW FOR ADDING DATA......................... -->
<div class="form-group row add">
    <div class="col-md-8">
        <input type="text" class="form-control" id="name" name="name"
            placeholder="Enter some name" required >
        <p class="error text-center alert alert-danger hidden"></p>
    </div>
    <div class="col-md-4">
        <button class="btn btn-primary" type="submit" id="add">
            <span class="glyphicon glyphicon-plus"></span> ADD
        </button>
    </div>
</div>
{{csrf_field()}}
<!--................................ VIEW FOR DISPLAYING DATA......................... -->
<div class="table-responsive text-center">
    <table class="table table-borderless" id="table">
        <thead>
            <tr>
                <th class="text-center">Id</th>
                <th class="text-center">Name</th>

                <th class="text-center">Actions</th>
            </tr>
        </thead>
        @foreach($data as $item)
        <tr class="item{{$item->id}}">
            <td>{{$item->id}}</td>
            <td>{{$item->name}}</td>
            <td><button class="edit-modal btn btn-info" data-id="{{$item->id}}"
                    data-name="{{$item->name}}">
                    <span class="glyphicon glyphicon-edit"></span> Edit
                </button>
                <button class="delete-modal btn btn-danger" data-id="{{$item->id}}"
                    data-name="{{$item->name}}">
                    <span class="glyphicon glyphicon-trash"></span> Delete
                </button></td>
        </tr>
        @endforeach
    </table>
</div>
<!-- MODEL TO OPEN JUST A POP-UP BOX AFTER CLICKING, ON "ADD,DELETE,EDIT"............................................................................................................ -->
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
                            <label class="control-label col-sm-2" for="name">Name:</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" id="n">
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

<script type="text/javascript">
//THIS AJAX CODE IS USED TO ADD AN ITEM IN THE DATABASE.............................................................................................................................
$("#add").click(function() {
 
    $.ajax({
        type: 'post',
        url: '/addItem',
        data: {
            '_token': $('input[name=_token]').val(),
            'name': $('input[name=name]').val()
        },
        success: function(data) {
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                $('.error').text(data.errors.name);
            } else {
                $('.error').addClass('hidden');
                $('#table').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.name + "</td><td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-name='" + data.name + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-name='" + data.name + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
            }
        },
    });
    $('#name').val('');
});

//AJAX CODE IS USED TO EDIT THE SPECIFIC RECORD FROM TABULAR DATA...................................................................................................................
$(document).on('click', '.edit-modal', function() 
        {
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
                $('#n').val($(this).data('name'));
                $('#myModal').modal('show');
        }     );
//THIS CODE RUNS WHEN UPDATE BUTTON IS CLICKED TO UPDATE A SPECIFIC RECORD..........................................................................................................
$('.modal-footer').on('click', '.edit', function() 
    {
        $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
     
            $.ajax({
                type: 'POST',
                url: '/editItem',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $("#fid").val(),
                    'name': $('#n').val()
                },
                success: function(data) 
                {
                    $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.name + "</td><td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-name='" + data.name + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-name='" + data.name + "' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
                }
            });
        });
//WHEN DELETE BUTTON IS CLICKED THEN THIS JQUERY CODE EXECUTES....................................................................................................................
$(document).on('click', '.delete-modal', function() 
{
        $('#footer_action_button').text(" Delete");
        $('#footer_action_button').removeClass('glyphicon-check');
        $('#footer_action_button').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').addClass('delete');
        $('.modal-title').text('Delete');
        $('.did').text($(this).data('id'));
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        $('.dname').html($(this).data('name'));
        $('#myModal').modal('show');
});

//WHEN DELETE BUTTON FROM MODEL IS CLICKED THEN THIS CODE EXECUTES................................................................................................................
$('.modal-footer').on('click', '.delete', function() 
{
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
</body>
</html>