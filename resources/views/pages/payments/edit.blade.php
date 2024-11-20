@extends('layouts.app')
@section('title', ' - Update Payment')
@section('content')
        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">{{ __('app.update_payment') }}</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- Form row -->
                    <div class="row">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-body">

                                    <form method="POST" id="save-payment-data-form" action="{{ route('payments.update', $payment->id) }}">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3">
                                            <p><span class="req">*</span> = required fields</p>
                                        </div>

                                        <div class="mb-3">
                                            <label for="utr_no" class="form-label">{{ __('Unique Transaction Reference') }} <span class="req">*</span></label>
                                            <input type="text" name="utr_no" autocomplete="off" class="form-control" id="utr_no" placeholder="{{ __('placeholder.utr_no') }}" value="{{ $payment->utr_no }}" />

                                            @if($errors->has('utr_no'))
                                                <p class="req">{{ $errors->first('utr_no') }}</p>
                                            @endif

                                        </div>

                                         <div class="mb-3">
                                            <label for="transaction_date" class="form-label">{{ __('Transaction Date') }} <span class="req">*</span></label>
                                            <input type="date" name="transaction_date" autocomplete="off" class="form-control" id="transaction_date" placeholder="{{ __('placeholder.transaction_date') }}" value="{{ $payment->transaction_date }}" />

                                            @if($errors->has('transaction_date'))
                                                <p class="req">{{ $errors->first('transaction_date') }}</p>
                                            @endif

                                        </div>

                                         <div class="mb-3">
                                            <label for="amount" class="form-label">{{ __('Amount') }} <span class="req">*</span></label>
                                            <input type="number" name="amount" autocomplete="off" class="form-control" id="amount" placeholder="{{ __('placeholder.amount') }}" value="{{ $payment->amount }}" />

                                            @if($errors->has('amount'))
                                                <p class="req">{{ $errors->first('amount') }}</p>
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