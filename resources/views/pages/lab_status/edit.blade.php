@extends('layouts.app')
@section('title', ' - Equipments Delivery Information')
@section('content')
		<div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">{{ __('app.equipments_delivery_information') }}</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- Form row -->
                    <div class="row">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-body">

                                    <form method="POST" id="save-user-data-form" action="{{ route('users.update', $user->id) }}">
                                        @csrf
                                        @method('PUT')

                           				<div class="mb-3">
                                            <p><span class="req">*</span> = required fields</p>
                                        </div>

                                        <div class="mb-3">
                                            <label for="name" class="form-label">{{ __('Name') }} <span class="req">*</span></label>
                                            <input type="text" name="name" autocomplete="off" class="form-control" id="name" placeholder="{{ __('placeholder.name') }}" value="{{ $user->name }}" />

                                            @if($errors->has('name'))
                                                <p class="req">{{ $errors->first('name') }}</p>
                                            @endif

                                        </div>


                                        <div class="mb-3">
                                            <label for="email" class="form-label">{{ __('Email') }} <span class="req">*</span></label>
                                            <input type="text" name="email" autocomplete="off" class="form-control" id="email" placeholder="{{ __('placeholder.email') }}" value="{{ $user->email }}" />

                                            @if($errors->has('email'))
                                                <p class="req">{{ $errors->first('email') }}</p>
                                            @endif

                                        </div>


                                        <div class="mb-3">
                                            <label for="password" class="form-label">{{ __('Password') }} </label>
                                            <input type="password" name="password" autocomplete="off" class="form-control" id="password" placeholder="{{ __('placeholder.password') }}" value="{{ old('password') }}" />
                                            <p><small class="sm">Min: 6 Characters</small></p>

                                            @if($errors->has('password'))
                                                <p class="req">{{ $errors->first('password') }}</p>
                                            @endif

                                        </div>

                                        <div class="mb-3">
                                            <label for="address1" class="form-label">{{ __('Address1') }} <span class="req">*</span></label>
                                            <!-- <input type="text" name="address1" autocomplete="off" class="form-control" id="address1" placeholder="{{ __('placeholder.address1') }}" value="{{ $user->profile->address1 ?? '' }}" /> -->

                                            <textarea name="address1" autocomplete="off" class="form-control" id="address1" placeholder="{{ __('placeholder.address1') }}">{{ $user->profile->address1 ?? '' }}</textarea>


                                            @if($errors->has('address1'))
                                                <p class="req">{{ $errors->first('address1') }}</p>
                                            @endif

                                        </div>
                                       

                                        <div class="mb-3">
                                            <label for="address2" class="form-label">{{ __('Address2') }} </label>
                                            <!-- <input type="text" name="address2" autocomplete="off" class="form-control" id="address2" placeholder="{{ __('placeholder.address2') }}" value="{{ $user->profile->address2 ?? '' }}" /> -->

                                            <textarea name="address2" autocomplete="off" class="form-control" id="address2" placeholder="{{ __('placeholder.address2') }}">{{ $user->profile->address2 ?? '' }}</textarea>

                                            @if($errors->has('address2'))
                                                <p class="req">{{ $errors->first('address2') }}</p>
                                            @endif

                                        </div>

                                        <div class="mb-3">
                                            <label for="mobile" class="form-label">{{ __('Mobile') }} <span class="req">*</span></label>
                                            <input type="text" name="mobile" autocomplete="off" class="form-control" id="address2" placeholder="{{ __('placeholder.mobile') }}" value="{{ $user->profile->mobile ?? '' }}" />

                                            @if($errors->has('mobile'))
                                                <p class="req">{{ $errors->first('mobile') }}</p>
                                            @endif

                                        </div>

                                        <div class="mb-3">
                                            <label for="role_id" class="form-label">{{ __('Role') }} <span class="req">*</span></label>
                                            <select name="role_id" id="" class="form-control">
                                                @foreach($roles as $key => $role)
                                                    <option value="{{ $role->id }}" {{ ($role->id == $assigned_role) ? "selected" : "" }}>{{ ucwords($role->name) }}</option>
                                                @endforeach
                                            </select>

                                            @if($errors->has('role_id'))
                                                <p class="req">{{ $errors->first('role_id') }}</p>
                                            @endif

                                        </div>

                                        <button type="submit" class="btn btn-primary waves-effect waves-light"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send feather-sm fill-white me-2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>Submit</button>

                                    </form>

                                </div> <!-- end card-body -->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- container -->
            </div> <!-- content -->
        </div>
@endsection