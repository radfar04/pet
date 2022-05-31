
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

