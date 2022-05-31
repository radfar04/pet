
  <!-- Modal -->
  <div class="modal" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    	<div class="alert alert-danger" style="display:none"></div>
      <div class="modal-header">
      	
        <h5 class="modal-title">Store Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table width="100%">
         <td>
          <div class="row">
            <label for="Name" class="col-sm-3 col-form-label text-right">Name:</label>
            <div class="form-group col-md-8"><input type="text" class="form-control" name="name" id="name"></div>
          </div>
          <div class="row">
              <label for="Location" class="col-sm-3 col-form-label text-right">Location:</label>
              <div class="form-group col-md-8">
                <select type="text" class="form-control" name="loc_id" id="loc_id"></select>
              </div>
          </div>
          <div class="row">
              <label for="Category" class="col-sm-3 col-form-label text-right">	Category:</label>
              <div class="form-group col-md-8">
                <select type="text" class="form-control" name="cat_id" id="cat_id"></select>
              </div>
          </div>
          <div class="row">
             <label for="SubCat"  class="col-sm-3 col-form-label text-right">	SubCat:</label>
             <div class="form-group col-md-8">
                <select type="text" class="form-control" name="subcat_id" id="subcat_id"></select>
              </div>
          </div>
          <div class="row">
             <label for="Price"  class="col-sm-3 col-form-label text-right">	Price:</label>
             <div class="form-group col-md-8">
                <input type="text" class="form-control" name="price" id="price">
              </div>
          </div>          
          <div class="row" style="display:none">
             <div class="form-group col-md-4">
                <label for="ID">	ID:</label>
                <input type="text" class="form-control" name="id" id="id">
              </div>
          </div>
          </td>
          <td>
            <label for="Description" class="col-sm-2 col-form-label">Description:</label>
            <div class="form-group col-md-9"><textarea type="textarea" class="form-control" name="description" id="description" width="100%" rows="10" cols="20"></textarea></div>
          </td>
          </table>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button  class="btn btn-success" id="ajaxSubmit">Save changes</button>
        </div>
    </div>
</div>
<script>
         var urls = $("#universal_url").val()+"/api/store";
         jQuery(document).ready(function(){
            jQuery('#ajaxSubmit').click(function(e){
               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               var url = urls + '/'+jQuery('#id').val()+
                         '?name='         +jQuery('#name').val()+
                         '&loc_id='     +jQuery('#loc_id').val()+
                         '&cat_id='     +jQuery('#cat_id').val()+
                         '&subcat_id='     +jQuery('#subcat_id').val()+
                         '&description='   +jQuery('#description').val()+
                         '&price='        +jQuery('#price').val()+
                         '&id='        +jQuery('#id').val();
               jQuery.ajax({
                  url: url,
                  method: 'put',
                  success: function(result){
                    if(!result.code)
                  	{
                  		jQuery('.alert-danger').html('<td>Error</td>');
                 			jQuery('.alert-danger').show();
                 			jQuery('.alert-danger').append('<li>'+result.message+'</li>');
                  	}
                  	else
                  	{
                  		console.log(result);
                      jQuery('.alert-danger').hide();
                      hideModal();
                      location.reload(); 
                  	}
                  }});
               });
            });
$(".img-fluid").click(function() { 
  var url = urls+'/'+$(this).attr( "dat" );
  $.ajax({
    url: url,
    success: function(r) {
        var k = r[0];
        var cat = r[1];
        var subcat = r[2];
        var location = r[3];
        $("#name").val(k.name);
        $("#price").val(k.price);
        $("#description").val(k.description);
        $("#id").val(k.id);
        cat.forEach(function(e, i){
            if(e.categories_id === k.cat_id)
                $('#cat_id').append($('<option selected></option>').val(e.categories_id).text(e.cat)); 
                else $('#cat_id').append($('<option></option>').val(e.categories_id).text(e.cat)); 
        });
        if(k.subcat_id === null) $('#subcat_id').append($('<option selected></option>'));
        subcat.forEach(function(e, i){
            if(k.cat_id === e.categories_id){
                if(e.sub_id === k.subcat_id)
                    $('#subcat_id').append($('<option selected></option>').val(e.sub_id).text(e.subcat)); 
                else $('#subcat_id').append($('<option></option>').val(e.sub_id).text(e.subcat)); 
            }    
        });
        location.forEach(function(e, i){
            if(e.location_id === k.loc_id)
                 $('#loc_id').append($('<option selected></option>').val(e.location_id).text(e.l_name)); 
            else $('#loc_id').append($('<option></option>').val(e.location_id).text(e.l_name)); 
        });
    },
    error: function(xhr) {
        console.log(xhr);
    }
  });
});    
function hideModal() {
  $("#myModal").removeClass("modal");
  $(".modal-backdrop").remove();
  $("#myModal").hide();
}         
$(".img-delete").click(function() { 
  var url = urls+'/'+$(this).attr( "dat" );
  $('#dialog-confirm').prop('title', 'Do you Want to delete?');
  $( "#dialog-confirm" ).dialog({ 
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      buttons: {
        "Delete": function() {
          $.ajax({
            url: url,
            type : 'DELETE',
            success: function(r) {
              location.reload(); 
              $( this ).dialog( "close" );
            },
            error: function(xhr) {
                console.log(xhr);
            }
          });
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });






});
$(".nsort").click(function() {
  var cats   = GetURLParameter('cats');
  var subcat = GetURLParameter('subcat');
  var locs   = GetURLParameter('locs');
  var cdate  = GetURLParameter('cdate');
  var udate  = GetURLParameter('udate');
  var desc   = GetURLParameter('desc');
  $('#cats').val(cats);
  $('#subcat').val(subcat);
  $('#locs').val(locs);
  $('#cdate').val(cdate);
  $('#udate').val(udate);
  $('#desc').val(desc);
  var elem   = $(this).html();
  if(elem === 'Name') elem = 'name' 
  else if (elem === 'Entered Date') elem = 'entered_at'
  else elem = 'price';
  $('#elem').val(elem);
  $('#order').val($('#order').val() === 'asc' ? 'desc' : 'asc');
  $( "#target" ).submit();
});
function GetURLParameter(sParam)
{
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) 
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) 
        {
            return sParameterName[1];
        }
    }
}
</script>
<script>
var urlk = $("#universal_url").val()+"/api/getcat";
$('#cat_id').change(function(){
    var url = urlk+'/'+$(this).val();
  $.ajax({
    url: url,
    success: function(r) {
        $("#subcat_id").empty();
        $.each(r,function(e, i){ 
            $('#subcat_id').append($('<option></option>').val(i.sub_id).text(i.subcat)); 
        }); 
    },
    error: function(xhr) {
        console.log(xhr);
    }
  });
});
</script>

