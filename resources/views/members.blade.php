<x-app-layout>
<section class="relative py-60 bg-white bg-gray-200 min-w-screen animation-fade animation-delay">
<meta charset="utf-8">
<style>
.modal-backdrop
{
    opacity:0.5 !important;
}
</style>
    <div class="container h-full max-w-5xl mx-auto overflow-hidden rounded-lg shadow">
    <table width="100%">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Created Date</th>
        <th>Updated Date</th>
    </tr>
    <tr>
        <div> 
            <form autocomplete="off" id="search_form" method="get" action="{{ route('members') }}">
            <td class="font-bold text-red-900 nowrap">
                <input type="text"  name="sname" id="sname" placeholder="Name">
            </td>
            <td class="font-bold text-red-900 nowrap">
                <input type="text"  name="semail" id="semail" placeholder="Email">
            </td>
            <td class="font-bold text-red-900 nowrap">    
                <input type="text"  name="cdate" id="cdate" placeholder="Create Date">
            </td>
            <td class="font-bold text-red-900 nowrap">
                <input type="text"  name="udate" id="udate" placeholder="Update Date">
            </td>
            <td>
            </td>                
            <td class="font-bold text-red-900 nowrap">
                <input id="excel" name="excel" title='Press for excel' type='checkbox' >
                <button id="submit" type='submit' ><span>Search</span></button>
            </td>
            </form>   
        </div>
    </tr>        
    @foreach($t as $l)
        <tr>    
            <td class="px-3 py-2 text-left nowrap">
                    {{ $l->name }}
            </td>
            <td class="font-bold text-red-900 nowrap">{{ $l->email }}</td>
            <td class="font-bold text-red-900 nowrap">{{  date("m/d/Y",strtotime($l->created_at)) }}</td>
            <td class="font-bold text-red-900 nowrap">{{  date("m/d/Y",strtotime($l->updated_at)) }}</td>
            <td class="font-bold text-red-900">
            <td><img src="{{ asset('images/editit.png')}}" dat='{{$l->id}}'  data-toggle="modal" data-target="#myModal" id="open" class="img-fluid" title="Modify" style="width:20px;height:20px; display: inline;"></td>
            </td>
        </tr>
    @endforeach
</table>
@include('members_modal')
</section>
</x-app-layout>
<script>

</script>    
