@extends('layouts.app')
@section('title', ' - Add Committee')
@section('content')
		<div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">{{ __('app.add_committee') }}</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- Form row -->
                    <div class="row">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-body">

                                    <form method="POST" id="save-team-data-form" action="{{ route('teams.store') }}">
                                        @csrf

                           				<div class="mb-3">
                                            <p><span class="req">*</span> = required fields</p>
                                        </div>

                                        <div class="mb-3">
                                            <label for="committee" class="form-label">{{ __('app.committee') }} <span class="req">*</span></label>
                                            <input type="text" name="committee" autocomplete="off" class="form-control" id="committee" placeholder="{{ __('app.committee') }}" value="{{ old('committee') }}" />

                                            @if($errors->has('committee'))
                                                <p class="req">{{ $errors->first('committee') }}</p>
                                            @endif

                                        </div>

                                        <div class="mb-3">
                                            <label for="experts" class="form-label">{{ __('Experts') }} <span class="req">*</span></label>
                                            <select name="experts[]" class="form-control" multiple>
                                                @foreach($experts as $expert)
                                                  <option {{ in_array($expert->user_id, old('experts') ?? []) ? "selected" : "" }} value="{{ $expert->user_id }}">{{ $expert->first_name }}</option>
                                                @endforeach
                                            </select> 
                                            <p><small><strong>To select multiple:</strong> ( Mac: cmd + click, Windows: ctrl + click )</small></p>

                                            @if($errors->has('experts'))
                                                <p class="req">{{ $errors->first('experts') }}</p>
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

@push('scripts')
<script>
    function roleSelect(id) {
        if (id == 3) {
            $('.inst_container').removeClass('d-none');
        } else {
            $('.inst_container').addClass('d-none');
        }
    }
</script>
@endpush
