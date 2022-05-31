@extends('livewire.layout')
<section class="relative py-60 bg-white bg-gray-200 min-w-screen animation-fade animation-delay">
<div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
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
        @error('target')
            <p class="text-red-500 mt-1">{{ $message }}</p>
        @enderror  
        <input class="block w-full mt-1 form-input" wire:model="target" placeholder="Email Address" id="email" autocomplete="off" type="email" required>
        <input class="block w-full mt-1 form-input" wire:model="subject" placeholder="Subject" id="subject" type="text" autocomplete="off" required>
        <textarea class="block w-full mt-1 form-textarea" wire:model="text" rows="3" placeholder="Email Text"></textarea>
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
            <input type="file" id="doc" name="doc" wire:model="doc">  
            <div x-show="isUploading">
                <progress max="100" x-bind:value="progress"></progress>
            </div>
        </div>
        <div class="pt-3">
            <button wire:click="submit" class="flex px-6 py-3 text-white bg-indigo-500 rounded-md hover:bg-indigo-600 hover:text-white focus:outline-none focus:shadow-outline focus:border-indigo-300" type="submit">
                <span class="self-center float-left ml-3 text-base font-medium">Send</span>
            </button>
         </div>
   </div>
</div>
</section>