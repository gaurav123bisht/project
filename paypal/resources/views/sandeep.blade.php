@extends('layouts.app')
@section('content')
<form  role="form" method="post" action="{{route('editItem')}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id">ID:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="fid">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="name">Name:</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" id="n">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="name">Name:</label>
                            <div class="col-sm-10">
                                <button type="" id="sub">submit</button>
                            </div>
                        </div>
                    </form>
@endsection
@push('scripts')
<script type="text/javascript">
// 	$('#sub').click(function(e){
// 		e.preventDefault();
// 		 $.ajaxSetup({
//   headers: {
//     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//   }
// });
     
// 	$.ajax({
//                 type: 'post',
//                 url: '/editItem',
//                 data: {
//                     '_token': $('input[name=_token]').val(),
//                     'id': $("#fid").val(),
//                     'name': $('#n').val()
//                 },
//                 success: function(data) 
//                 {
//                     $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.name + "</td><td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-name='" + data.name + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-name='" + data.name + "' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
//                 }
//             });
// });
</script>
@endpush