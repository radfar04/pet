<link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
<x-guest-layout>
<x-slot name="logo">
    <x-jet-authentication-card-logo />
</x-slot>
<body>
    <section class="min-h-screen flex items-stretch text-white ">
        <div class="lg:flex w-1/2 hidden bg-gray-500 bg-no-repeat bg-cover relative items-center" style="background-image: url(https://images.unsplash.com/photo-1577495508048-b635879837f1?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=675&q=80);">
            <div class="absolute bg-black opacity-60 inset-0 z-0"></div>

            <div class="bottom-0 absolute p-4 text-center right-0 left-0 flex justify-center space-x-4">
            </div>
        </div>
        <div class="lg:w-1/2 w-full flex items-center justify-center text-center md:px-16 px-0 z-0" style="background-color: #161616;">
            <div class="absolute lg:hidden z-10 inset-0 bg-gray-500 bg-no-repeat bg-cover items-center" style="background-image: url(https://images.unsplash.com/photo-1577495508048-b635879837f1?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=675&q=80);">
                <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
            </div>
            <div class="w-full py-6 z-20">
            <x-jet-validation-errors class="mb-4" />
            <form method="POST" action="{{ route('login') }}" class="sm:w-2/3 w-full px-4 lg:px-0 mx-auto">
                @csrf
                <div>
                <x-jet-label class="block font-medium text-sm text-yellow-700 text-left text-black" for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" style="color:black" type="email" name="email" :value="old('email')" required autofocus autocomplete="current-email" />
            </div>

            <div class="mt-4">
                <x-jet-label class="block font-medium text-sm text-yellow-700 text-left text-black" for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" style="color:black" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-yellow-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-yellow-600 hover:text-yellow-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-yellow-700 underline">Register</a>
                @endif
                            <a href="{{ url('register') }}" class="ml-4 text-sm text-yellow-700 underline">Register</a>
                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
            </div>
        </div>
    </section>
</body>
</x-jet-authentication-card>