<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo src="{{ asset('assets/images/5glogo.png') }}" width="190" />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your mobile number and we will sent you a new password.') }}
        </div>

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


        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.forgot.mobile') }}">
            @csrf

            <div class="block">
                <x-label for="mobile" value="{{ __('Mobile') }}" />
                <x-input autocomplete="off" id="mobile" class="block mt-1 w-full" type="number" name="mobile" :value="old('mobile')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a style="margin-right:15px;" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('Login') }}
                </a>
                <x-button>
                    {{ __('Submit') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
