<!DOCTYPE html>
<link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<link rel="stylesheet" type="text/css" href="{{   env('APP_TYPE', 'pet').'/css/lightpick.css' }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="{{   env('APP_TYPE', 'pet').'/js/lightpick.js' }}"></script>    
<meta name="_token" content="{{csrf_token()}}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.3/css/bootstrap.css" rel="stylesheet">  
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.3/js/bootstrap.min.js"></script> 
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous">
</script>
      <!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>


        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet"  href="{{ env('APP_TYPE', 'pet').'/css/app.css' }}">
        <input type ="hidden" id="universal_url" value="{{env('APP_URL').env('APP_TYPE')}}">
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ env('APP_TYPE', 'pet').'/js/app.js' }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $slot }}
            </main>
            @livewire('navigation-menu')
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
<script>
    if( $('#documents').length ){ 
       $( "#documents" ).click(function(){
           $("#docs").toggle();
       });
    }  
    if( $('#stores').length ){ 
       $( "#stores" ).click(function(){
           $("#store").toggle();
       });
    } 
    if( $('#sites').length ){ 
       $( "#sites" ).click(function(){
           $("#sit").toggle();
       });
    }       
</script>
<script>
     if( $('#datepicker').length ){ 
         var picker = new Lightpick({ field: document.getElementById('datepicker') });
     }
     if( $('#cdate').length ){ 
         var picker = new Lightpick({ field: document.getElementById('cdate') });
     }
     if( $('#udate').length ){ 
         var picker = new Lightpick({ field: document.getElementById('udate') });
     }          
</script>
