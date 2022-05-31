
  <!-- Modal -->
  <div class="modal" tabindex="-1" role="dialog" id="storeCat">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
    	<div class="alert alert-danger" style="display:none"></div>
      <div class="modal-header">
      	
        <h5 class="modal-title">Create Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                  <div><p id='errcat' style='display:none; color:red'></p></div>
                  <div class="row">
                    <label for="Cat" class="col-sm-3 col-form-label text-right">Category:</label>
                    <div class="form-group col-md-8">
                    <input type="text" name="cat" id="cat" list="catname" class="form-control">
                        <datalist id="catname">
                        @foreach($cats as $c)
                            <option value='{{{ $c->cat }}}'>
                        @endforeach
                        </datalist>           
                    </div>
                  </div>
              <div class="modal-footer">
              	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button  class="btn btn-success" id="savecat">Save changes</button>
                </div>
       </div>
       </div>
   </div>
</div>
<script>
function hideModal() {
  $("#storeCat").removeClass("modal");
  $(".modal-backdrop").remove();
  $("#storeCat").hide();
}         
</script>
<script>
$('#savecat').click(function(e){
e.preventDefault(); // avoid to execute the actual submit of the form.
var urls = $("#universal_url").val()+"/api/addcat";
var cat = $('#cat').val();
var data = { 'cat' : cat};
   $.ajax({
      type: 'POST',
      url: urls,
      data: data,
      success: function(r) { 
          if(r.code){
                hideModal();
                location.reload(); 
          } else {
            $("#errcat").empty();  
            var ele = document.getElementById('errcat');
            ele.innerHTML += r.message+'<br>';
            $("#errcat").show();
          } 
      }
    });
});

</script>  
