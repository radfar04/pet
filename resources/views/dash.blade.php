<x-app-layout>   
    <section class="relative py-60 bg-white bg-gray-200 min-w-screen animation-fade animation-delay">
        <div class="container h-full max-w-5xl mx-auto overflow-hidden rounded-lg shadow">
       <table>  
        @if(!isset($mode))
            <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('docAdd') }}">
                    <img src="{{ asset('images/add.png')}}" class="img-fluid" title="Add Document" style="width:50px;height:50px;">
                    </a>
                    <a href="{{ route('docList') }}">
                    <img src="{{ asset('images/list.png')}}" class="img-fluid" title="List Documents" style="width:50px;height:50px;">
                    </a>
                    <a href="{{ route('docSearch') }}">
                    <img src="{{ asset('images/search.png')}}" class="img-fluid" title="Search Documents" style="width:50px;height:50px;">
                    </a>
            </div>       
        @elseif($mode == 'add') 
            {{{ Form::open(array('url' => '/uploaddoc','files'=>'true')) }}}
            <tr>
            <td>
            {{{ Form::Label('cat', 'Category: ') }}}
            </td>
            <td>
            <select name="cats" id="cats">
            @foreach($cats as $c)
                <option value="{{$c->id}}">{{$c->cat}}</option>
            @endforeach
            </select>
            <select name="subcat" id="subcat" style="display:none">
            @if(!empty($subcat))
            @foreach($subcat as $c)
                <option value="{{$c->id}}">{{$c->cat}}</option>
            @endforeach
            @endif
            </select>
            {{{ Form::Label('addcat', 'Add Category',["title"=>"Click to function","id"=>"addcat"]) }}}
            {{{Form::text('newcat',null,["style"=>"display:none;","id"=>"newcat"])}}}
            {{{Form::text('newsubcat',null,["style"=>"display:none;","id"=>"newsubcat"])}}}
            {{{ Form::button('Save',["style"=>"display:none;","id"=>"catid"]) }}}
            </td>
            </tr>
            <tr>
            <td>
            {{{ Form::Label('desc', 'Description: ') }}}
            </td>
            <td>
            {{{ Form::textarea('desc', '') }}}
            </td>
            </tr>
            <tr>
            <td colspan='3'>
            {{{ Form::file('image') }}}            
            </td>
            <td>
            </tr>
            <tr>
            <td colspan='3'>
            {{{ Form::submit('Upload File') }}}
            {{{ Form::close() }}}
            </td>
            </tr>
        </div>
        @elseif($mode == 'done')
        <!--   <div class="flex-shrink-0 flex items-center"> -->
           <p>{{{ $arr[0]}}}</p> <br/>
           <p>{{{ "File Name: ".$arr[1]}}}</p> <br/>
           <p>{{{ "Category: ".$arr[2]}}}</p> <br/>
           <p>{{{ "Type: ".$arr[3]}}}</p> <br/>
           <p>{{{ "Size: ".$arr[4]}}}</p> <br/>
           <p>{{{ "Mime Type: ".$arr[5]}}}</p> <br/>
           <p>{{{ "Description: ".$arr[6]}}}</p>
                  
        @endif        
         </td>
        </tr>
        <tr>
        <td id='mess' style="display:none;">
        <p id='par' style="color:red"></p>
        </td>
        </tr>
   </table>     
  </div>
  </section>
</x-app-layout>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
var mess = "{{{isset($mess) ? $mess : ''}}}";
if (mess != ''){
    $("#mess" ).show();
    $("#par").html(mess);
}
$( "#addcat" ).click( function() {
    $("#catid" ).toggle();
    $("#newsubcat" ).toggle();
    $("#newcat" ).toggle();
});
$( "#catid" ).click( function() {
    $.ajax({
               type:'POST',
               url:'addIt',
               data: { newcat:$("#newcat").val(),newsubcat:$("#newsubcat").val() , _token: '{{csrf_token()}}' },
               success:function(data) {
                   window.location.href = "{{{ route('docAdd') }}}"+data;
               }
            });
});
$( "#cats" ).change(function() {
var cat_id = $(this).find(':selected').val();
$.ajax({
               type:'GET',
               url:'getSubcat',
               data: { cat_id:cat_id, _token: '{{csrf_token()}}' },
               success:function(r) {
                   $("#subcat").empty();
                   $("#subcat").append(new Option('', '0'));
                   console.log(r);
                   r = jQuery.parseJSON(r);
                   if (r.success == 'Y'){
                    $.each(r.subcat, function (i, item) {
                        $('#subcat').append($('<option>', { 
                                value: item.id,
                                text : item.subcat 
                        }));
                        $("#subcat").show();
                    });
                   } else
                   window.location.href = "{{{ route('docAdd') }}}"+r.mess;
               }
            });
});  
</script>
