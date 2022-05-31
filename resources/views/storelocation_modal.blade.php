
  <!-- Modal -->
  <div class="modal" tabindex="-1" role="dialog" id="storelocation">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
    	<div class="alert alert-danger" style="display:none"></div>
      <div class="modal-header">
      	
        <h5 class="modal-title">Create Location</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div><p id='errloc' style='display:none; color:red'></p></div>
            <div class="row">
              <label for="location" class="col-sm-3 col-form-label text-right">Location:</label>
              <div class="form-group col-md-8">
                <input type="text" class="form-control" name="loca" id="loca" list="locname">
                    <datalist id="locname">
                    @foreach($locs as $c)
                        <option value="{{$c->location_id}}" >{{$c->l_name}}</option>
                    @endforeach
                    </datalist>  
              </div>
          </div>
          <div class="row">
            <label for="subcat_id"  class="col-sm-3 col-form-label text-right">	Descrition:</label>
            <div class="form-group col-md-8">
                <textarea type="textarea" class="form-control" name="desc" id="desc" width="100%" rows="10" cols="50"></textarea>
            </div>
          </div>              <div class="modal-footer">
              	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button  class="btn btn-success" id="savelocation">Save changes</button>
                </div>
       </div>
       </div>
   </div>
</div>
<script>
function hideModal() {
  $("#storelocation").removeClass("modal");
  $(".modal-backdrop").remove();
  $("#storelocation").hide();
}         
</script>
<script>
$('#savelocation').click(function(e){
e.preventDefault(); // avoid to execute the actual submit of the form.
var urls = $("#universal_url").val()+"/api/addlocation";
var loca = $('#loca').val();
var data = { 'l_name' : loca,'l_description' : $('#desc').val()};
   $.ajax({
      type: 'POST',
      url: urls,
      data: data,
      success: function(r) { 
          if(r.code){
                hideModal();
                location.reload(); 
          } else {
            $("#errloc").empty();  
            var ele = document.getElementById('errloc');
            ele.innerHTML += r.message+'<br>';
            $("#errloc").show();
          } 
      }
    });
});

</script>  
