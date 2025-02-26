<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            @if(app('request')->input('telecom') == 1)
            <h2 style="background:rgb(31 41 55);color:#fff;padding:5px 10px;font-weight:700">TELECOM PROJECT MANAGEMENT
            </h2>
            @else
            <x-authentication-card-logo src="{{ asset('assets/images/5glogo.png') }}" width="230" />
            @endif
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
        @endif

        @if (session('error'))
        <div class="mb-4 font-medium text-sm text-red-600">
            {{ session('error') }}
        </div>
        @endif

        {!! parichay_login() !!}

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <!-- <div class="mt-4">
                 <x-label for="" value="{{ __('Captcha') }}" />
                 <p class="mt-3 flex" id="captcha_img"></p>
                 <x-input id="captcha" class="block mt-1 w-full mt-2" type="text" name="captcha" autocomplete="off" required />
                 <x-input id="key" class="block mt-1 w-full" type="hidden" name="key" autocomplete="off" />
            </div> -->


            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                <a style="margin-right: 106px;"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('register') }}">
                    {{ __('Register') }}
                </a>
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="#">
                    {{ __('Forgot your password?') }}
                </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>