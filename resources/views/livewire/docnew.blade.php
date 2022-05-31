@extends('livewire.layout')
    <section class="relative py-60 bg-white bg-gray-200 min-w-screen animation-fade animation-delay">
        <div class="container h-full max-w-5xl mx-auto overflow-hidden rounded-lg shadow">
            @if($none != 'none')
                @livewire('addcat')
            @endif
        </div>
        <div class="container h-full max-w-5xl mx-auto overflow-hidden rounded-lg shadow">
            @if($success)
            <div id="mess" wire:click="refresh" title="Click to refresh">
                <div style="text-align: left">
                    <div class="inline-flex w-half ml-3 overflow-hidden bg-red rounded-lg shadow-sm">                        <div class="flex items-center justify-center w-12 bg-green-500"></div>
                        <div class="px-3 py-2 text-left">
                                <span class="font-bold text-red-500"></span>
                                <p class="mb-1 text-sm leading-none text-red-500">{{ $success }}</p>
                        </div>
                    </div>
                </div>  
            </div>
            @endif    
            <div class="h-half sm:flex justify-left"></div>
                <div>
                    @error('cats')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
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
                    <button wire:click="toggle" title = "Click to function" class="text-gray-900 cursor-pointer hover:bg-blue-200 focus:text-blue-700 focus:bg-blue-200 focus:outline-none focus:ring-blue-600" tabindex="1">
                        Add Category
                    </button>
                </div>
                <div>
                    {{{ Form::textarea('desc', '',["wire:model"=>"desc"]) }}}
                </div>
                <div
                    x-data="{ isUploading: false, progress: 0 }"
                    x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false"
                    x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                >
                @error('doc')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                @enderror                    
                <input type="file" id="doc" name="doc" wire:model.lazy="doc" multiple>  
                <div x-show="isUploading">
                    <progress max="100" x-bind:value="progress"></progress>
                </div>
                </div>
                <div class="pt-3">
                    <button wire:click="submit" class="flex px-6 py-3 text-white bg-indigo-500 rounded-md hover:bg-indigo-600 hover:text-white focus:outline-none focus:shadow-outline focus:border-indigo-300" type="submit">
                        <span class="self-center float-left ml-3 text-base font-medium">Submit</span>
                    </button>
                </div>
            </div>
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
 
<script>
/*
    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook('component.initialized', (component) => {alert('1')})
        Livewire.hook('element.initialized', (el, component) => {alert('2')})
        Livewire.hook('element.updating', (fromEl, toEl, component) => {alert('3')})
        Livewire.hook('element.updated', (el, component) => {alert('4')})
        Livewire.hook('element.removed', (el, component) => {alert('5')})
        Livewire.hook('message.sent', (message, component) => {alert('6')})
        Livewire.hook('message.failed', (message, component) => {alert('7')})
        Livewire.hook('message.received', (message, component) => {alert('8')})
        Livewire.hook('message.processed', (message, component) => {alert('9')})
    });
*/
</script>
