@extends('layouts.app')
@section('title', ' - Update User')
@section('content')
		<div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">{{ __('app.update_user') }}</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- Form row -->
                    <div class="row">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-body">

                                    <form enctype="multipart/form-data" method="POST" id="save-institute-user-form" action="{{ route('institute_users.update', $instituteUser->id) }}">
                                        @csrf
                                        @METHOD('PUT')

                           				<div class="mb-3">
                                            <p><span class="req">*</span> = required fields</p>
                                        </div>

                                        @if($instituteUser->profile_pic)
                                            <div class="mb-3" style="text-align:center">
                                                    <img style="border:2px solid #999" width="80" height="80" class="rounded-circle" src="{{ url('storage/profile/' . $instituteUser->profile_pic) }}" alt="" />
                                            </div>
                                        @endif

                                        <div class="mb-3">
                                            <label for="institute" class="form-label">{{ __('labels.first_name') }} <span class="req">*</span></label>
                                            <input type="text" name="first_name" autocomplete="off" class="form-control" id="first_name" placeholder="{{ __('placeholder.first_name') }}" value="{{ $instituteUser->first_name }}" />

                                            @if($errors->has('first_name'))
                                                <p class="req">{{ $errors->first('first_name') }}</p>
                                            @endif

                                        </div>


                                        <div class="mb-3">
                                            <label for="last_name" class="form-label">{{ __('labels.last_name') }} <span class="req">*</span></label>
                                            <input type="text" name="last_name" autocomplete="off" class="form-control" id="last_name" placeholder="{{ __('placeholder.last_name') }}" value="{{ $instituteUser->last_name }}" />

                                            @if($errors->has('last_name'))
                                                <p class="req">{{ $errors->first('last_name') }}</p>
                                            @endif

                                        </div>



                                        <div class="mb-3">
                                            <label for="phone_no" class="form-label">{{ __('labels.phone_no') }} <span class="req">*</span></label>
                                            <input type="text" name="phone_no" autocomplete="off" class="form-control" id="phone_no" placeholder="{{ __('placeholder.phone_no') }}" value="{{ $instituteUser->phone_no }}" />

                                            @if($errors->has('phone_no'))
                                                <p class="req">{{ $errors->first('phone_no') }}</p>
                                            @endif

                                        </div>


                                        <div class="mb-3">
                                            <label for="email" class="form-label">{{ __('labels.email') }} <span class="req">*</span></label>
                                            <input type="text" name="email" autocomplete="off" class="form-control" id="email" placeholder="{{ __('placeholder.email') }}" value="{{ $instituteUser->email_id }}" />

                                            @if($errors->has('email'))
                                                <p class="req">{{ $errors->first('email') }}</p>
                                            @endif

                                        </div>

                                        <div class="mb-3">
                                            <label for="user_name" class="form-label">{{ __('labels.user_name') }} <span class="req">*</span></label>
                                            <input type="text" name="user_name" autocomplete="off" class="form-control" id="user_name" placeholder="{{ __('placeholder.user_name') }}" value="{{ $instituteUser->username }}" />
                                            @if($errors->has('user_name'))
                                                <p class="req">{{ $errors->first('user_name') }}</p>
                                            @endif

                                        </div>

                                        <div class="mb-3">
                                            <label for="gender" class="form-label">{{ __('labels.gender') }} <span class="req">*</span></label>

                                            <select name="gender" id="gender" class="form-control">
                                                @foreach($gender as $key => $value)
                                                        <option {{ $instituteUser->gender == $key ? "selected" : "" }} value="{{ $key }}">{{ ucfirst(strtolower($value)) }}</option>
                                                @endforeach
                                            </select>

                                            @if($errors->has('gender'))
                                                <p class="req">{{ $errors->first('gender') }}</p>
                                            @endif

                                        </div>


                                        <div class="mb-3">
                                            <label for="user_type" class="form-label">{{ __('labels.user_type') }} <span class="req">*</span></label>
                                            <select name="user_type" class="form-control">
                                                @foreach($user_type as $key => $value)
                                                    <option {{ $instituteUser->user_type == $key ? "selected" : "" }} value="{{ $key }}">{{ ucfirst(strtolower($value)) }}</option>
                                                @endforeach
                                            </select>

                                            @if($errors->has('user_type'))
                                                <p class="req">{{ $errors->first('user_type') }}</p>
                                            @endif

                                        </div>

                                        <div class="mb-3 d-none">
                                            <label for="status" class="form-label">{{ __('labels.profile_pic') }} </label>
                                            <p><input type="file" name="profile_pic" id="profile_pic" accept="image/*" /></p>
                                            <p><small><i>allowed extenstion:</i> <strong>jpg, jpeg, png, gif</strong></small></p>
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