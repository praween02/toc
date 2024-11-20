<x-guest-layout>
    <x-workshop-card>
        <x-slot name="logo">
        	
        </x-slot>
        <style type="text/css">
          span.req{color:#ff0000}
        </style>

	<h2 class="mt-5" style="font-size:16px;margin-bottom:15px"><strong>Workshop on Telecommunications Standards Development Society is organized by DoT on 08.05.2024</strong></h2>

	<p style="text-align:justify;line-height:22px;font-size:13px;letter-spacing:0.5px">The Department of Telecommunications (DoT), in collaboration with the Telecommunications Standards Development Society, India (TSDSI) and the Telecommunication Engineering Centre (TEC), organise a full-day Standardization workshop themed "Achieving Leadership in Standards: Leveraging India's Potential through Intellectual Property (IP)". This engaging event will take place on <strong>8th May 2024 from 10 AM to 5 PM</strong> at the <strong>IIIT Bangalore campus</strong>.</p>

        <p class="text-right" style="font-size:11px"><span class="req">*</span> = required filed</p>

        <x-validation-errors class="mb-4" />

        @if (session('success'))
            <div class="mb-4 font-medium text-sm text-green-600" style="background:#e2ffe3;height:40px;border:1px solid #8df391;line-height:40px;padding-left:10px;">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 font-medium text-sm text-red-600" style="background:#fde8e8;height:40px;border:1px solid #dfa9a9;line-height:40px;padding-left:10px;">
                {{ session('error') }}
            </div>
        @endif
        
        <form method="POST" action="{{ route('workshop.join') }}">
            @csrf

            <div class="mt-4">
                <label for="person_name" class="form-label">{{ __('Name of Person') }} <span class="req">*</span></label>
                <x-input autocomplete="off" id="name_of_person" class="block mt-1 w-full" type="text" name="person_name" :value="old('person_name')" required autofocus autocomplete="off" />
            </div>

            <div class="mt-4">
                <label for="organisation_name" class="form-label">{{ __('Organisation Name') }} <span class="req">*</span></label>
                <x-input autocomplete="off" id="Organisation Name" class="block mt-1 w-full" type="text" name="organisation_name" :value="old('organisation_name')" required autofocus autocomplete="off" />
            </div>


            <div class="mt-4">
                <label for="email_id" class="form-label">{{ __('Email Id') }} <span class="req">*</span></label>
                <x-input id="email_id" class="block mt-1 w-full" type="text" name="email_id" :value="old('email_id')" required autofocus autocomplete="off" />
            </div>

            <div class="mt-4">
                <label for="contact_no" class="form-label">{{ __('Contact No') }} <span class="req">*</span></label>
                <x-input id="contact_no" class="block mt-1 w-full" type="number" min="0" name="contact_no" :value="old('contact_no')" required autofocus autocomplete="off" />
            </div>

            <div class="mt-4">
                <label for="expertise_in" class="form-label">{{ __('Expertise in') }} <span class="req">*</span></label>
                <x-input id="expertise_in" class="block mt-1 w-full" type="text" name="expertise_in" :value="old('expertise_in')" required autofocus autocomplete="off" />
            </div>

            <div class="mt-4" class="mt-4">
                <label for="purpose_to_attend_workshop" class="form-label">{{ __('Purpose to attend Workshop') }} <span class="req">*</span></label>
                <x-input id="purpose_to_attend_workshop" class="block mt-1 w-full" type="text" name="purpose_to_attend_workshop" required autocomplete="off" :value="old('purpose_to_attend_workshop')" />
            </div>

            <div class="flex items-center justify-center mt-4">
                <x-button class="ms-4">
                    {{ __('SUBMIT') }}
                </x-button>
            </div>
        </form>
    </x-workshop-card>
</x-guest-layout>
