@extends('livewire.layout')
    <section class="relative py-60 bg-white bg-gray-100 min-w-screen animation-fade animation-delay">
    @include('wait')
        <div class="container h-full max-w-7xl mx-auto overflow-hidden rounded-lg shadow">
        @if($list)
            <div class="h-half sm:flex justify-left">
            <table>
                <tr>
                    <th>File</th>
                    <th>Category</th>
                    <th>SubCategory</th>
                    <th>Date</th>
                    <th>Description</th>
                </tr>
                @foreach($list as $l)
                <tr>    
                    <td class="px-3 py-2 text-left nowrap">
                        <button wire:click="export('{{$l->cat}}','{{ isset($l->subcat) ? $l->subcat : ''  }}','{{ $l->filename }}')">
                            {{ $l->filename }}
                        </button>
                    </td>
                    <td class="font-bold text-red-900 nowrap">{{ $l->cat }}</td>
                    <td class="font-bold text-red-900 nowrap">{{ isset($l->subcat) ? $l->subcat : '' }}</td>
                    <td class="font-bold text-red-900 nowrap">{{ $l->created_at }}</td>
                    <td class="font-bold text-red-900       ">{{ $l->description }}</td>
                </tr>
            @endforeach
            </table>
            </div>
            <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">$("#subcat").remove();$("#cats").remove();</script>
        @else
            <div> 
                {{{ Form::Label('cat', 'Category: ') }}}
                @error('cats')<p class="text-red-500 mt-1">{{ $message }}</p> @enderror
                <select name="cats" id="cats" wire:model.lazy="cats">
                        <option value=""></option>
                @foreach($cats as $c)
                    @if(isset($selectedCat) && $selectedCat == $c->id)
                        <option value="{{$c->id}}" selected >{{$c->cat}}</option>
                    @else
                        <option value="{{$c->id}}" >{{$c->cat}}</option>
                    @endif
                @endforeach
                </select>
                @if($subcat)
                    <select name="subcat" id="subcat" wire:model.lazy="subcat">
                                <option value=""></option>
                        @foreach($subcat as $c)
                            @if(isset($selectedSubCat) && $selectedSubCat == $c->id)
                                <option selected value="{{$c->id}}">{{$c->subcat}}</option>
                            @else
                                <option value="{{$c->id}}">{{$c->subcat}}</option>
                            @endif    
                        @endforeach
                    </select>
                @endif
            </div>
            <div>
                {{{ Form::Label('desc', 'KeyWords: ') }}}
                {{{ Form::text('desc', '',["wire:model"=>"desc"]) }}}
            </div>
            <div class="pt-3">
                <button wire:click="submit" class="flex px-6 py-3 text-white bg-indigo-500 rounded-md hover:bg-indigo-600 hover:text-white focus:outline-none focus:shadow-outline focus:border-indigo-300" type="submit">
                    <span class="self-center float-left ml-3 text-base font-medium">Submit</span>
                </button>
            </div>
        @endif
        </div>
    </section>  
<script>
    document.addEventListener("DOMContentLoaded", () => 
    {   
        Livewire.hook('message.processed', (message, component) => {fixBug()})
    });
    function fixBug(){
        const selectBoxes = document.querySelectorAll('select');
        selectBoxes.forEach(function (s) {
            const selectedOption = s.querySelector('option[selected]');
            if (selectedOption) {
                s.value = selectedOption.value;
            }
        });  
    }
</script>   