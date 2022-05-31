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
    <form action='find' id='target'>
    <table>
    <tr> 
        <th class='nsort'>Name</th>
        <th class='nsort'>Entered Date</th>
        <th class='nsort' style = 'text-align: center;'>Price</th>
    </tr>
    @foreach($store as $l)  
        <tr> 
            <td class="font-bold text-red-900 nowrap">{{ $l->name }}</td>
            <td class="font-bold text-red-900 nowrap">{{ changeFormat($l->entered_at,"m/d/Y") }}</td>
            <td class="font-bold text-red-900 nowrap" style="text-align: right">{{  $l->price }}</td>
            <td class="font-bold text-red-900">
            <td><img src="{{ asset('images/editit.png')}}" dat='{{$l->id}}'  data-toggle="modal" data-target="#myModal" id="open" class="img-fluid" title="Modify" style="width:20px;height:20px; display: inline;"></td>
            <td><img src="{{ asset('images/delete.png')}}" dat='{{$l->id}}'  id="open" class="img-delete" title="Delete" style="width:20px;height:20px; display: inline;"></td>
            </td>
        </tr>
    @endforeach
    <input type='hidden' id='cats' name='cats'>
    <input type='hidden' id='subcat' name='subcat'>
    <input type='hidden' id='locs' name='locs'>
    <input type='hidden' id='cdate' name='cdate'>
    <input type='hidden' id='udate' name='udate'>
    <input type='hidden' id='desc' name='desc'>
    <input type='hidden' id='elem' name='elem'>
    <input type='hidden' id='order' name='order' value='{{$order}}'>
</table>
</form>
</div>
</div>
@include('storeadd_modal')
@include('popup')
</div>
</section>
</x-app-layout>
