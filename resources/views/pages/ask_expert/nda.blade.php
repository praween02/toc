@extends('layouts.app')
@section('title', ' - Ask Expert')
@section('content')
<style type="text/css">
   small{font-size:10px;color:#958d46;letter-spacing:0.4px}
   .datepicker-days table tr td { text-align:center;cursor:pointer; }
   ul.err li {color:#ff0000;}  
</style>
<div class="content-page">
   <div class="content">
      <!-- Start Content-->
      <div class="container">
         <!-- Form row -->
         <div class="row">
            <div class="col-12">
               <div class="card">
                  <div class="card-body">

                     <form id="nda-form" enctype="multipart/form-data" class="" action="{{ route('expert.nda.submit') }}" accept-charset="utf-8" method="post">
                        @csrf

                        <div id="errors"></div>

                        <div class="row">
                           <div class="col-sm-12 mb-3">
                                 <h3 class="text-center text-info text-uppercase">Non-Disclosure Agreement (NDA)</h3>
                           </div>
                        </div>
                        
                        <div class="row">
                           <div class="col-sm-12 mb-3 text-right">
                                 <a target="_blank" href="{{ asset('assets/non_disclosure_agreement_nda.pdf') }}" download><button type="button" class="btn btn-success"><i class="fa fa-download"></i> Download NDA</button></a>
                           </div>
                        </div>

                        <div class="row">

                            @if($nda)
                              <p><a download target="_blank" href="{{ url('storage/uploads/' . $nda) }}">{{ $nda }}</a></p>
                            @endif

                            <div class="col-sm-4 mb-3">
                                 <input type="file" class="form-control" name="nda" />
                                 <small>only .docx file</small>
                                 @if($errors->has('nda'))
                                    <p class="req">{{ $errors->first('nda') }}</p>
                                 @endif
                           </div>

                            <div class="col-sm-8 mb-3">
                                 <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
                           </div>
                        </div>
    

                     </form>

                  </div>
                  <!-- end card-body -->
               </div>
               <!-- end card-->
            </div>
            <!-- end col -->
         </div>
         <!-- end row -->
      </div>
      <!-- container -->
   </div>
   <!-- content -->
</div>
@endsection
@push('scripts')
<script src="{{ asset('assets/js/bootstrap-datepicker.min.js?v=1.0') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.min.js?v=1.0') }}"></script>
<script src="{{ asset('assets/js/expert-user-validation.js?v=' . rand(111111,999999)) }}"></script>
<script>
   $(document).ready(function() {
       $(`.datepicker1`).datepicker({ autoclose: true, format: 'yyyy-mm-dd' });
   });
 </script>
@endpush