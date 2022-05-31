@extends('livewire.layout')
    <section class="relative py-60 bg-white bg-gray-200 min-w-screen animation-fade animation-delay">
        <div class="container h-full max-w-5xl mx-auto overflow-hidden rounded-lg shadow">
            @if ($success)
            <div wire:click="refresh" title="Click to refresh">
                <div style="text-align: left">
                    <div class="inline-flex w-half ml-3 overflow-hidden bg-white rounded-lg shadow-sm">                        <div class="flex items-center justify-center w-12 bg-green-500"></div>
                        <div class="px-3 py-2 text-left">
                                <span class="font-semibold text-green-500">Success</span>
                                <p class="mb-1 text-sm leading-none text-gray-500">{{ $success }}</p>
                        </div>
                    </div>
                </div>  
            </div>    
            @endif
            <div class="pb-3">
                            @error('date')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                            <input wire:model="date" class="w-half px-5 py-3 border border-gray-400 rounded-lg outline-none focus:shadow-outline" autocomplete="off" type="text" placeholder="Date" name="date" id="datepicker" />
                        </div>
                        <div class="py-3">
                            @error('time')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                            <input wire:model="time" class="w-half px-5 py-3 border border-gray-400 rounded-lg outline-none focus:shadow-outline" type="text" placeholder="Name" name="name" value="{{ old('name') }}" />
                        </div>
                        <div class="py-3">
                            @error('desc')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                            <textarea wire:model="desc" row="4" class="w-half h-40 px-5 py-3 border border-gray-400 rounded-lg outline-none focus:shadow-outline" name="comment" placeholder="Your message here...">{{ old('comment') }}</textarea>
                        </div>
            <div class="h-half sm:flex justify-left">
                    <form wire:submit.prevent="submit" method="POST" class="w-half">
                        @csrf
                        <div class="pt-3">
                            <button class="flex px-6 py-3 text-white bg-indigo-500 rounded-md hover:bg-indigo-600 hover:text-white focus:outline-none focus:shadow-outline focus:border-indigo-300" type="submit">
                                <span class="self-center float-left ml-3 text-base font-medium">Submit</span>
                            </button>
                        </div>
                          @if(isset($arr))
                            @foreach($arr as $a)
                              <div>
                                  <img  wire:click="deleteIt({{{$a->id}}})"  src="{{ asset('images/delete.png')}}" class="img-fluid" title="Delete" style="width:20px;height:20px; display: inline;">
                                  <span>{{{ date('m/d/Y H:i:s',strtotime($a->dt))}}} </span>
                                  <span style="color: red;">{{{ $a->description}}}</span>
                              </div>
                            @endforeach  
                          @endif
                    </form>
            </div>
        </div>
    </section>
