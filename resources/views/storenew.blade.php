<x-app-layout>
<section class="relative py-60 bg-white bg-gray-200 min-w-screen animation-fade animation-delay">
<meta charset="utf-8">
<style>
.modal-backdrop
{
    opacity:0.5 !important;
}
</style>  
    <div class="container h-full max-w-5xl mx-auto overflow-text rounded-lg shadow">
    <form action='store' method="post" id="idForm">
    <table>
    <td> 
    <div class="row">
            <label for="name" class="col-sm-3 col-form-label text-right">Name:</label>
            <div class="form-group col-md-8"><input type="text" class="form-control" name="name" id="name"></div>
          </div>
          <div class="row">
              <label for="location" class="col-sm-3 col-form-label text-right">Location:</label>
              <div class="form-group col-md-8">
                <select type="text" class="form-control" name="loc_id" id="loc_id">
                    <option></option>
                    @foreach($locs as $c)
                        <option value="{{$c->location_id}}" >{{$c->l_name}}</option>
                    @endforeach
                </select>  
              </div>
              <img src="{{ asset('images/add.png')}}"  data-toggle="modal" data-target="#storelocation" id="addlocation" class="img-fluid" title="Add Location" style="width:20px;height:20px; display: inline;">
          </div>
          <div class="row">
              <label for="cat_id" class="col-sm-3 col-form-label text-right">	Category:</label>
              <div class="form-group col-md-8">
                <select type="text" class="form-control" name="cat_id" id="cat_id">
                    <option></option>
                    @foreach($cats as $c)
                        <option value="{{$c->categories_id}}" >{{$c->cat}}</option>
                    @endforeach
                </select>
              </div>
              <img src="{{ asset('images/add.png')}}"  data-toggle="modal" data-target="#storeCat" id="addcat" class="img-fluid" title="Add Category" style="width:20px;height:20px; display: inline;">
          </div>
          <div class="row">
            <label for="subcat_id"  class="col-sm-3 col-form-label text-right">	SubCat:</label>
            <div class="form-group col-md-8">
                <select type="text" class="form-control" name="subcat_id" id="subcat_id">
                <option></option>
                </select>  
            </div>
            <img src="{{ asset('images/add.png')}}"  data-toggle="modal" data-target="#storesubCat" id="addsubcat" class="img-fluid" title="Add SubCat" style="width:20px;height:20px; display: inline;">
          </div>
          <div class="row">
             <label for="price"  class="col-sm-3 col-form-label text-right">	Price:</label>
             <div class="form-group col-md-8">
                <input type="text" class="form-control" name="price" id="price">
              </div>
          </div>  
          <div>
                <input id="submit" type='submit'  title="Add Inventory" class="text-white bg-indigo-500 rounded-md hover:bg-indigo-600 hover:text-white focus:outline-none focus:shadow-outline focus:border-indigo-300">
          </div>
          </td>
          <td>
            <div><p id='error' style='display:none; color:red'></p></div>
            <label for="description" class="col-sm-2 col-form-label">Description:</label>
            <div class="form-group col-md-9"><textarea type="textarea" class="form-control" name="description" id="description" width="100%" rows="10" cols="50"></textarea></div>
          </td>
          <td>
            @include('storecat_modal')
            @include('storesubcat_modal')
            @include('storelocation_modal')
          </td>
</table>
</form>
</div>
</div>
</div>
</section>
</x-app-layout>
<script>
var urls = $("#universal_url").val()+"/api/getcat";
$('#cat_id').change(function(){
    var url = urls+'/'+$(this).val();
  $.ajax({
    url: url,
    success: function(r) {
        $("#subcat_id").empty();
        $('#subcat_id').append($('<option></option>')); 
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
<script>
$("#idForm").submit(function(e) {
e.preventDefault(); // avoid to execute the actual submit of the form.
var form = $(this);
var actionUrl = form.attr('action');
$.ajax({
    type: "POST",
    url: 'store',
    data: form.serialize(),
    success: function(data)
    {
      console.log(data);
      $.each(data,function(i,k){
          if(i==='id'){
            window.location.href = $("#universal_url").val()+"/api/find?id="+k;
          }else{
             ele = document.getElementById('error');
             ele.innerHTML += k+'<br>';
             $("#error").show();
          }
      }) 
    }
});

});
$('.form-control').change(function() {
  $("#error").empty();
});
</script>