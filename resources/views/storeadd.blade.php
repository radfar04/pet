@extends('livewire.layout')
<x-app-layout>
<section class="relative py-60 bg-white bg-gray-200 min-w-screen animation-fade animation-delay">
<meta charset="utf-8">
<style>
.modal-backdrop
{
    opacity:0.5 !important;
}
</style>
    <meta name="_token" content="{{csrf_token()}}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.3/css/bootstrap.css" rel="stylesheet">  
      <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.3/js/bootstrap.min.js"></script> 
    <div class="container h-full max-w-5xl mx-auto overflow-hidden rounded-lg shadow">
    <table>
    <tr>
        <th>Name</th>
        <th>Location</th>
        <th>Category</th>
        <th>Entered Date</th>
        <th>Price</th>
    </tr>
    @foreach($store as $l)
        <tr>    
            <td class="font-bold text-red-900 nowrap">{{ $l->name }}</td>
            <td class="font-bold text-red-900">{{ $l->location }}</td>
            <td class="font-bold text-red-900">{{ $l->category }}</td>
            <td class="font-bold text-red-900 nowrap">{{  date("m/d/Y",strtotime($l->entered_at)) }}</td>
            <td class="font-bold text-red-900 nowrap">{{  $l->price }}</td>
            <td class="font-bold text-red-900">
            <td><img src="{{ asset('images/editit.png')}}" dat='{{$l->id}}'  data-toggle="modal" data-target="#myModal" id="open" class="img-fluid" title="Modify" style="width:20px;height:20px; display: inline;"></td>
            </td>
        </tr>
    @endforeach
</table>
</div>
</div>
  <!-- Modal -->
  <div class="modal" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    	<div class="alert alert-danger" style="display:none"></div>
      <div class="modal-header">
      	
        <h5 class="modal-title">User Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
            <label for="User" class="col-sm-2 col-form-label">User:</label>
            <div class="form-group col-md-4">
              <input type="text" class="form-control" name="user" id="user">
            </div>
          </div>
          <div class="row">
              <label for="Email" class="col-sm-2 col-form-label">Email:</label>
              <div class="form-group col-md-4">
                <input type="text" class="form-control" name="email" id="email">
              </div>
          </div>
          <div class="row">
              <label for="Created Date" class="col-sm-2 col-form-label">	Created Date:</label>
              <div class="form-group col-md-4">
                <input type="text" class="form-control" name="cdate" id="cdate">
              </div>
          </div>
          <div class="row">
             <label for="Update Date"  class="col-sm-2 col-form-label">	Update Date:</label>
             <div class="form-group col-md-4">
                <input type="text" class="form-control" name="udate" id="udate">
              </div>
          </div>
          <div class="row">
            <label for="Role"  class="col-sm-2 col-form-label">Role:</label>
            <div class="form-group col-md-4">
              <input type="text" class="form-control" name="role" id="role">
            </div>
          </div>
          <div class="row">
            <label for="Password"  class="col-sm-2 col-form-label">Password:</label>
            <div class="form-group col-md-4">
              <input type="password" class="form-control" name="password" id="password">
            </div>
          </div>
          <div class="row" style="display:none">
             <div class="form-group col-md-4">
                <label for="ID">	ID:</label>
                <input type="text" class="form-control" name="id" id="id">
              </div>
          </div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button  class="btn btn-success" id="ajaxSubmit">Save changes</button>
        </div>
    </div>
  </div>
</div>
</section>
</x-app-layout>
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous">
      </script>
      <!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      <script>
         jQuery(document).ready(function(){
            jQuery('#ajaxSubmit').click(function(e){
               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               jQuery.ajax({
                  url: "{{ url('memberupdate') }}",
                  method: 'post',
                  data: {
                     name: jQuery('#user').val(),
                     email: jQuery('#email').val(),
                     created_at: jQuery('#cdate').val(),
                     updated_at: jQuery('#udate').val(),
                           role: jQuery('#role').val(),
                       password: jQuery('#password').val(),
                             id: jQuery('#id').val(),
                  },
                  success: function(result){
                    if(!result.code)
                  	{
                  		jQuery('.alert-danger').html('<td>Error</td>');
                 			jQuery('.alert-danger').show();
                 			jQuery('.alert-danger').append('<li>'+result.message+'</li>');
                  	}
                  	else
                  	{
                  		jQuery('.alert-danger').hide();
                      hideModal();
                      location.reload(); 
                  	}
                  }});
               });
            });
$(".img-fluid").click(function() {
  $.ajax({
    url: "memberedit/"+$(this).attr( "dat" ),
    success: function(r) {
        var k = r[0];
        $("#user").val(k.name);
        $("#email").val(k.email);
        $("#cdate").val(k.created_at);
        $("#udate").val(k.updated_at);
        $("#role").val(k.role);
        $("#id").val(k.id);
    },
    error: function(xhr) {
      alert(xhr);
    }
  });
});    
function hideModal() {
  $("#myModal").removeClass("modal");
  $(".modal-backdrop").remove();
  $("#myModal").hide();
}        
      </script>

