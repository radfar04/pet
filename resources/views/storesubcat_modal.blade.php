
  <!-- Modal -->
  <div class="modal" tabindex="-1" role="dialog" id="storesubCat">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
    	<div class="alert alert-danger" style="display:none"></div>
      <div class="modal-header">
      	
        <h5 class="modal-title">Create SubCategory</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                  <div><p id='err' style='display:none; color:red'></p></div>
                  <div class="row">
              <label for="cat_id" class="col-sm-3 col-form-label text-right">	Category:</label>
              <div class="form-group col-md-8">
                <select type="text" class="form-control" name="cat_idSub" id="cat_idSub">
                    <option></option>
                    @foreach($cats as $c)
                        <option value="{{$c->categories_id}}" >{{$c->cat}}</option>
                    @endforeach
                </select>
              </div>
          </div>
          <div class="row">
            <label for="subcat_id"  class="col-sm-3 col-form-label text-right">	SubCat:</label>
            <div class="form-group col-md-8">
              <input type="text" name="subcatsubcat" id="subcatsubcat" list="subcatname" class="form-control">
                          <datalist id="subcatname">
                          </datalist>           
            </div>
          </div>              
              <div class="modal-footer">
              	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button  class="btn btn-success" id="savesubcat">Save changes</button>
              </div>
       </div>
       </div>
   </div>
</div>
<script>
function hideModal() {
  $("#storesubCat").removeClass("modal");
  $(".modal-backdrop").remove();
  $("#storesubCat").hide();
}         
</script>
<script>
$('#savesubcat').click(function(e){
e.preventDefault(); // avoid to execute the actual submit of the form.
var urls = $("#universal_url").val()+"/api/addsubcat";
var cat = $('#cat_idSub').val();
var subcat = $('#subcatsubcat').val()
var data = { 'categories_id' : cat,'subcat' : subcat};
   $.ajax({
      type: 'POST',
      url: urls,
      data: data,
      success: function(r) { 
          if(r.code){
                hideModal();
                location.reload(); 
          } else {
            $("#err").empty();  
            var ele = document.getElementById('err');
            ele.innerHTML += r.message+'<br>';
            $("#err").show();
          } 
      }
    });
});

</script>  
<script>
var urlk = $("#universal_url").val()+"/api/getcat";
$('#cat_idSub').change(function(){
    var url = urlk+'/'+$(this).val();
  $.ajax({
    url: url,
    success: function(r) {
        $("#subcatsubcat").empty();
        $.each(r,function(e, i){ 
            console.log(i);
            $('#subcatname').append("<option value='" +i.subcat + "'></option>");
        }); 
    },
    error: function(xhr) {
        console.log(xhr);
    }
  });
});
</script>