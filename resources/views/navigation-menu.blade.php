@extends('livewire.layout')
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
<!-- component -->
    <div class="fixed flex flex-col top-0 left-0 w-64 bg-gray-900 h-full shadow-lg">
        <div class="flex items-center pl-6 h-20 border-b border-gray-800">
            <img src="{{ env('APP_TYPE', 'pet').'/'.Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="rounded-full h-10 w-10 flex items-center justify-center mr-3 border-2 border-blue-500">
            <div class="ml-1">
                <p class="ml-1 text-md font-medium tracking-wide truncate text-gray-100 font-sans">{{ Auth::user()->name }}</p>
            </div>
        </div>
        <div class="overflow-y-auto overflow-x-hidden flex-grow">
        <ul class="flex flex-col py-6 space-y-1">
            <li class="px-5">
                <div class="flex flex-row items-center h-8">
                    <div class="flex font-semibold text-sm text-gray-300 my-4 font-sans uppercase">Dashboard</div>
                </div>
            </li>
            <li>
                <a href="{{ route('dashboard') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-700 text-gray-500 hover:text-gray-200 border-l-4 border-transparent hover:border-blue-500 pr-6">
                    <span class="inline-flex justify-center items-center ml-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </span>
                    <span class="ml-2 font-semibold text-sm tracking-wide truncate font-sans">Home</span>
                </a>
            </li>
            <li class="px-5">
            <div class="flex flex-row items-center h-8">
                <div class="flex font-semibold text-sm text-gray-300 my-4 font-sans uppercase">Settings</div>
            </div>
            </li>
            <li>
            <a href="{{ route('profile.show') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-700 text-gray-500 hover:text-gray-200 border-l-4 border-transparent hover:border-blue-500 pr-6">
                <span class="inline-flex justify-center items-center ml-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </span>
                <span class="ml-2 font-semibold text-sm tracking-wide truncate font-sans">Profile</span>
            </a>
            </li>
            <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-700 text-gray-500 hover:text-gray-200 border-l-4 border-transparent hover:border-red-500 pr-6"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                <span class="inline-flex justify-center items-center ml-4 text-red-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </span>
                <span class="ml-2 font-semibold text-sm tracking-wide truncate font-sans">Logout</span>
                </a>
            </form>
            </li>
            <li>
            <a href="{{ route('reminder') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-700 text-gray-500 hover:text-gray-200 border-l-4 border-transparent hover:border-red-500 pr-6">
            <span class="inline-flex justify-center items-center ml-4 text-red-400 bg-light-black-300"">
                <img src="{{ asset('images/reminder.png')}}"  title="Reminder" style="width:20px;height:20px;">
            </span>
                <span class="ml-2 font-semibold text-sm tracking-wide truncate font-sans">Reminder</span>
            </a>
            </li>
            <span>
            <li  id="documents">
            <a href="#" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-700 text-gray-500 hover:text-gray-200 border-l-4 border-transparent hover:border-red-500 pr-6">
            <span class="inline-flex justify-center items-center ml-4 text-red-400 bg-light-black-300"">
                <img src="{{ asset('images/documents.png')}}"  title="Reminder" style="width:20px;height:20px;">
            </span>
                <span class="ml-2 font-semibold text-sm tracking-wide truncate font-sans">Documents</span>
            </a>
            </li>
            <span style="display: none;" id="docs">
                <li style='position: relative; left: 30px;'>
                <a href="{{ route('docnew') }}">
                    <span class="inline-flex justify-center items-center ml-4 text-red-400 bg-light-black-300"">
                    <img src="{{ asset('images/add.png')}}" class="img-fluid" title="Add Document" style="width:20px;height:20px;">
                    <span class="ml-2 font-semibold text-sm tracking-wide truncate font-sans">Add</span>
                </a>                
                </li>
                <li style='position: relative; left: 30px;'>
                <a href="{{ route('searchdocs') }}">
                    <span class="inline-flex justify-center items-center ml-4 text-red-400 bg-light-black-300"">
                    <img src="{{ asset('images/search.png')}}" class="img-fluid" title="Search Document" style="width:20px;height:20px;">
                    <span class="ml-2 font-semibold text-sm tracking-wide truncate font-sans">Search</span>
                </a>                
                </li>
            </span>
            <span>
            <li>
            <a href="{{ route('emailing') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-700 text-gray-500 hover:text-gray-200 border-l-4 border-transparent hover:border-red-500 pr-6">
            <span class="inline-flex justify-center items-center ml-4 text-red-400 bg-light-black-300">
                <img src="{{ asset('images/emailing.png')}}"  title="Email" style="width:20px;height:20px;">
            </span>
                <span class="ml-2 font-semibold text-sm tracking-wide truncate font-sans">Send Email</span>
            </a>
            </li>
            </span>
            <span>
            <li  id="sites">
            <a href="#" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-700 text-gray-500 hover:text-gray-200 border-l-4 border-transparent hover:border-red-500 pr-6">
            <span class="inline-flex justify-center items-center ml-4 text-red-400 bg-light-black-300"">
                <img src="{{ asset('images/sites.png')}}"  title="Reminder" style="width:20px;height:20px;">
            </span>
                <span class="ml-2 font-semibold text-sm tracking-wide truncate font-sans">Sites</span>
            </a>
            </li>
            <span style="display: none;" id="sit">
                <li style='position: relative; left: 30px;'>
                <a href="http://localhost/voyager/public/admin">
                    <span class="inline-flex justify-center items-center ml-4 text-red-400 bg-light-black-300"">
                    <img src="{{ asset('images/voyager.png')}}" class="img-fluid" title="Add Document" style="width:20px;height:20px;">
                    <span class="ml-2 font-semibold text-sm tracking-wide truncate font-sans">Voyager</span>
                </a>                
                </li>
                <li style='position: relative; left: 30px;'>
                <a href="http://localhost/flarum/public">
                    <span class="inline-flex justify-center items-center ml-4 text-red-400 bg-light-black-300"">
                    <img src="{{ asset('images/flarum.png')}}" class="img-fluid" title="Search Document" style="width:20px;height:20px;">
                    <span class="ml-2 font-semibold text-sm tracking-wide truncate font-sans">Flarum</span>
                </a>                
                </li>
            </span>
            <span>
                <li>
                <a href="{{ route('members') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-700 text-gray-500 hover:text-gray-200 border-l-4 border-transparent hover:border-red-500 pr-6">
                <span class="inline-flex justify-center items-center ml-4 text-red-400 bg-light-black-300">
                    <img src="{{ asset('images/members.png')}}"  title="Email" style="width:20px;height:20px;">
                </span>
                    <span class="ml-2 font-semibold text-sm tracking-wide truncate font-sans">Members</span>
                </a>
                </li>
            </span>

            <span>
            <li  id="stores">
            <a href="#" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-700 text-gray-500 hover:text-gray-200 border-l-4 border-transparent hover:border-red-500 pr-6">
            <span class="inline-flex justify-center items-center ml-4 text-red-400 bg-light-black-300"">
                <img src="{{ asset('images/store.png')}}"  title="Reminder" style="width:20px;height:20px;">
            </span>
                <span class="ml-2 font-semibold text-sm tracking-wide truncate font-sans">Inventory</span>
            </a>
            </li>
            <span style="display: none;" id="store">
                <li style='position: relative; left: 30px;'>
                <a href="{{ url('api/new/?id='.Auth::id()) }}">
                    <span class="inline-flex justify-center items-center ml-4 text-red-400 bg-light-black-300"">
                    <img src="{{ asset('images/add.png')}}" class="img-fluid" title="Add Store" style="width:20px;height:20px;">
                    <span class="ml-2 font-semibold text-sm tracking-wide truncate font-sans">Add</span>
                </a>                
                </li>
                <li style='position: relative; left: 30px;'>
                <a href="{{  url('api/search/?id='.Auth::id())}}">
                    <span class="inline-flex justify-center items-center ml-4 text-red-400 bg-light-black-300"">
                    <img src="{{ asset('images/search.png')}}" class="img-fluid" title="Search Document" style="width:20px;height:20px;">
                    <span class="ml-2 font-semibold text-sm tracking-wide truncate font-sans">Search</span>
                </a>                
                </li>
            </span>
            <span>            

            <span>
                <li>
                <a href="{{ route('test') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-700 text-gray-500 hover:text-gray-200 border-l-4 border-transparent hover:border-red-500 pr-6">
                <span class="inline-flex justify-center items-center ml-4 text-red-400 bg-light-black-300"">
                    <img src="{{ asset('images/test.png')}}"  title="Reminder" style="width:20px;height:20px;">
                </span>
                    <span class="ml-2 font-semibold text-sm tracking-wide truncate font-sans">Test</span>
                </a>
                </li>
            </span>
        </ul>
        </div>
    </div>
    </nav>