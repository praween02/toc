@extends('layouts.app')
@section('title', ' - Project Timeline')
@section('content') 
@push('css')
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.min.css?v=1.0') }}" />   
<style>
 table{width:100%;border-collapse:collapse;margin-top:20px}
 td,th{border:1px solid #ddd;padding:10px;text-align:left}
 th{background-color:#f2f2f2}
 input[type=date]{width:100%;padding:8px;box-sizing:border-box}
 input[type=date]:not([value=""]){border:1px solid #ddd;border-radius:3px}.date-field{display:flex;justify-content:space-between;gap:10px}
 .srch{border:1px solid #ddd;border-radius:3px;height:30px;line-height:30px;width:155px}
 .datepicker{border:1px solid #999;}
  th{background-color:#2f316f;color:#fff}
  .invoice {
  width: 150px;
  padding: 10px;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border: 1px dashed #a09733;
  text-align: center;
  background-color:#fcf7c1;
  cursor: pointer;
}
.mt-1{margin-bottom:3px}
.mrgn{margin:5px !important}
small{font-size:10px;color:#705c04;letter-spacing:0.5px}
.multiselect-container,.btn-group{width:100% !important}
ul.multiselect-container{padding-bottom:5px}
.w-50{width:50% !important}
.rdio{width:100px;border:1px solid #ddd;border-radius:10px;padding:5px 10px;margin-right:10px;line-height:22px}
div.box{border:1px dashed #bdbaba;border-radius:5px;padding:5px;font-size:10px;margin-bottom:8px}
</style>
@endpush
        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container">
                    
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">{{ __('app.project_timeline') }}</h4>
                            </div>
                        </div>
                    </div>     
                    <!-- end page title --> 

                    <!-- Form row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <form id="project_timeline_form" method="POST" enctype="multipart/form-data">
                                  @csrf
                                    <div class="card-body">
                                        <div class="col-12">
                                            <p><strong>Select Institutes</strong> <span class="req">*</span></p>
                                            <p>
                                                <select name="institute_id" id="institute_id" class="form-control">
                                                    <option value="">-- Select Institute --</option>
                                                    @foreach ($institutes as $institute)
                                                        @php
                                                            $enc_inst_id = \Illuminate\Support\Facades\Crypt::encrypt($institute->id);
                                                            $get_enc_inst_id = Request::get('inst_id');
                                                            $selected = '';
                                                            if ($get_enc_inst_id) {
                                                                $dec_inst_id = \Illuminate\Support\Facades\Crypt::decrypt($get_enc_inst_id);
                                                                $selected = ($institute->id == $dec_inst_id) ? 'selected' : '';
                                                            }
                                                        @endphp
                                                        <option {{ $selected }} value="{{ $enc_inst_id }}">{{ $institute->institute }}</option>
                                                    @endforeach
                                                </select>

                                                @if($errors->has('institute_id'))
                                                    <p class="req">{{ $errors->first('institute_id') }}</p>
                                                @endif
                                            </p>
                                        </div>

                                        <div class="col-12">
                                            <p><strong>Select Equipments</strong> <span class="req">*</span></p>
                                            <p>
                                                @php
                                                    $equipments_data = old('equipments')?? [];
                                                @endphp
                                                <select name="equipments[]" class="form-control" id="equipments" multiple>

                                                    @foreach ($equipments as $equipment)
                                                        <option {{ @in_array($equipment->id, $equipments_data) ? "checked" : "" }} {{ in_array($equipment->id, $schedule_equipments_arr) ? "disabled" : "" }} value="{{ \Illuminate\Support\Facades\Crypt::encrypt($equipment->id) }}">{{ $equipment->equipment }}</option>
                                                    @endforeach
                                                </select>

                                                @if($errors->has('equipments'))
                                                    <p class="req">{{ $errors->first('equipments') }}</p>
                                                @endif
                                            </p>
                                        </div>

                                        <div class="row mt-3 schedule_timelines">
                                            <h4 class="mb-3" style="letter-spacing:1.0px;font-weight:bold;">SCHEDULE TIMELINES</h4>
                                           <!--  <div class="col-3">
                                                <p><strong><span class="label">Dispatch Date</span></strong> </p>
                                                <p>
                                                    <input autocomplete="off" type="text" name="dispatch_date" value="{{ old('dispatch_date') }}" class="form-control datepicker" id="" placeholder="Dispatch Date" /> 
                                                    @if($errors->has('dispatch_date'))
                                                        <p class="req">{{ $errors->first('dispatch_date') }}</p>
                                                    @endif
                                                </p>
                                            </div> -->
                                            
                                            <div class="col-3">
                                                <p><strong><span class="label">Delivery Date</span></strong> <span class="req">*</span></p>
                                                <p>
                                                    <input autocomplete="off" type="text" name="delivery_date" value="{{ old('delivery_date')  }}" placeholder="Delivery Date" class="form-control datepicker" id="" /> 
                                                    @if($errors->has('delivery_date'))
                                                        <p class="req">{{ $errors->first('delivery_date') }}</p>
                                                    @endif
                                                </p>
                                            </div>


                                            <div class="col-3">
                                                <p><strong><span class="label">Installation Date</span></strong> <span class="req">*</span></p>
                                                <p>
                                                    <input autocomplete="off" type="text" name="installation_date" value="{{ old('installation_date') }}" class="form-control datepicker" id="" placeholder="Installation Date" /> 
                                                    @if($errors->has('installation_date'))
                                                        <p class="req">{{ $errors->first('installation_date') }}</p>
                                                    @endif
                                                </p>
                                            </div>

                                            <div class="col-3">
                                                <p><strong><span class="label">Commission Date</span></strong> <span class="req">*</span></p>
                                                <p>
                                                    <input autocomplete="off" type="text" name="commission_date" value="{{ old('commission_date') }}" class="form-control datepicker" id=""  placeholder="Commission Date"/> 
                                                    @if($errors->has('commission_date'))
                                                        <p class="req">{{ $errors->first('commission_date') }}</p>
                                                    @endif
                                                </p>
                                            </div>

                                           <!--  <div class="col-6">
                                                <p><strong><span class="label">Dispatch PDF <small>(MAX SIZE: 10 MB)</small></span></strong> </p>
                                                <p>
                                                    <input autocomplete="off" type="file" name="dispatch_pdf" class="form-control" id="dispatch_pdf" accept="application/pdf"  placeholder="Upload Dispatch PDF"/> 
                                                    @if($errors->has('dispatch_pdf'))
                                                        <p class="req">{{ $errors->first('dispatch_pdf') }}</p>
                                                    @endif
                                                </p>

                                            </div> -->


                                        </div>

                                        <div class="col-12">
                                            <button type="submit" id="btnsbmt" class="btn btn-primary waves-effect waves-light"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send feather-sm fill-white me-2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>Submit</button>
                                        </div>


                                        <div class="col-12 mt-3" id="prefilled_data">
                                        </div>

                                
                                    </div> <!-- end card-body -->

                                </form>

                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h3>Scheduled Equipments List</h3>
                                    <div id="schedule_equipments">
                                        @if(empty(Request::get('inst_id')))
                                            <p>Please select an Institute to see scheduled equipments</p>
                                        @else
                                            <table class="table table-bordered dataTable">
                                              <thead>
                                                <tr>
                                                  <th scope="col">#</th>
                                                  <th scope="col">Equipment</th>
                                                  <th scope="col">Dispatch Date</th>
                                                  <!-- <th scope="col">Dispatch PDF</th> -->
                                                  <th scope="col">Delivery Date</th>
                                                  <th scope="col">Installation Date</th>
                                                  <th scope="col">Commission Date</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                @forelse($schedule_equipments as $equipment)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $equipment->equipment }}</td>

                                                    <td>
                                                        @if($equipment->equipment_dispatch_date)
                                                            <span>{{ date('D, j M\'y', strtotime($equipment->equipment_dispatch_date)) }}</span><br /><a target="_blank" download href="{{ url('storage/uploads/' . $equipment->dispatch_invoice_file) }}"><i class="fa fa-pdf"></i> {{ $equipment->dispatch_invoice_file }}</a>
                                                        @else
                                                            <span><button class="btn btn-sm btn-primary" onclick="update_dispatch_date('{{ \Illuminate\Support\Facades\Crypt::encrypt($equipment->pt_id) }}')">Update Dispatch Info</button></span>
                                                        @endif
                                                    </td>
                                                    <!-- <td>{{ date('D, j M\'y', strtotime($equipment->equipment_dispatch_date)) }}</td>
                                                    <td><a target="_blank" download href="{{ url('storage/uploads/' . $equipment->dispatch_invoice_file) }}"><i class="fa fa-pdf"></i> {{ $equipment->dispatch_invoice_file }}</a></td> -->

                                                    <td>
                                                        <div class="box"><strong>Scheduled Delivery:</strong> {{ date('D, j M\'y', strtotime($equipment->equipment_delivery_date)) }}</div>
                                                        <div class="box"><strong>Delivered:</strong> {{ (! empty($equipment->equipment_delivered_date) ? date("D, j M'y", strtotime($equipment->equipment_delivered_date)) :  'N/A') }}</div>

                                                        @php
                                                        $cls1 = '';
                                                        if((! empty($equipment->equipment_delivery_date)) &&  (! empty($equipment->equipment_delivered_date)))
                                                        {
                                                            if($equipment->equipment_delivery_date == $equipment->equipment_delivered_date)
                                                             {
                                                                    $cls1 = 'btn-success';
                                                             }
                                                            else
                                                              {
                                                                    $cls1 = 'btn-danger';
                                                              }
                                                              $date1 = strtotime($equipment->equipment_delivery_date);
                                                              $date2 = strtotime($equipment->equipment_delivered_date);
                                                              echo '<div class="box">No of days delayed: <strong>' . round(($date2 - $date1) / (60 * 60 * 24)). '</strong></div>';
                                                        }                                            
                                                        @endphp


                                                    </td>

                                                    <td>
                                                        <div class="box"><strong>Scheduled Install:</strong> {{ date('D, j M\'y', strtotime($equipment->equipment_install_date)) }}</div>
                                                        <div class="box"><strong>Installed:</strong> {{ (! empty($equipment->equipment_installed_date) ? date("D, j M'y", strtotime($equipment->equipment_installed_date)) :  'N/A') }}</div>

                                                        @php
                                                        $cls1 = '';
                                                        if((! empty($equipment->equipment_install_date)) &&  (! empty($equipment->equipment_installed_date)))
                                                        {
                                                            if($equipment->equipment_install_date == $equipment->equipment_installed_date)
                                                             {
                                                                    $cls1 = 'btn-success';
                                                             }
                                                            else
                                                              {
                                                                    $cls1 = 'btn-danger';
                                                              }
                                                              $date1 = strtotime($equipment->equipment_install_date);
                                                              $date2 = strtotime($equipment->equipment_installed_date);
                                                              echo '<div class="box">No of days delayed: <strong>' . round(($date2 - $date1) / (60 * 60 * 24)). '</strong></div>';
                                                        }                                            
                                                        @endphp

                                                    </td>

                                                    <td>
                                                        <div class="box"><strong>Scheduled Commission:</strong> {{ date('D, j M\'y', strtotime($equipment->equipment_commision_date)) }}</div>
                                                        <div class="box"><strong>Commissioned:</strong> {{ (! empty($equipment->equipment_commisioned_date) ? date("D, j M'y", strtotime($equipment->equipment_commisioned_date)) :  'N/A') }}</div>

                                                        @php
                                                        $cls1 = '';
                                                        if((! empty($equipment->equipment_commision_date)) &&  (! empty($equipment->equipment_commisioned_date)))
                                                        {
                                                            if($equipment->equipment_commision_date == $equipment->equipment_commisioned_date)
                                                             {
                                                                    $cls1 = 'btn-success';
                                                             }
                                                            else
                                                              {
                                                                    $cls1 = 'btn-danger';
                                                              }
                                                              $date1 = strtotime($equipment->equipment_commision_date);
                                                              $date2 = strtotime($equipment->equipment_commisioned_date);
                                                              echo '<div class="box">No of days delayed: <strong>' . round(($date2 - $date1) / (60 * 60 * 24)). '</strong></div>';
                                                        }                                            
                                                        @endphp


                                                    </td>

                                                 </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6">No any scheduled equipments</td>
                                                    </tr>
                                                @endforelse
                                              </tbody>
                                            </table>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  

                    
                </div> <!-- container -->
            </div> <!-- content -->
        </div>

        <!-- modal -->

        <!-- <div class="modal modalBox" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title modalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p id="modalMsg"></p>
              </div>
            </div>
          </div>
        </div> -->

        <div class="modal fade modalBox" id="updateDispatchModal" tabindex="-1" role="dialog" aria-labelledby="updateDispatchModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <form name="update_dispatch_info" class="" id="update_dispatch_info" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Dispatch Information</h5>
                    <button type="button" class="close4" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Dispatch Date <span class="req">*</span></label>
                        <input type="text" name="dispatch_date" class="form-control datepicker" id="dispatch_date" autocomplete="off" />
                      </div>
                      <div class="form-group">
                        <label for="message-text" class="col-form-label">Dispatch PDF <span class="req">*</span></label>
                        <input type="file" class="form-control" id="dispatch_pdf" name="dispatch_pdf" accept="application/pdf" />
                      </div>
                  </div>
                  <input type="hidden" name="pt_id" id="pt_id" value="" />
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="update_dispatch_btn">Update</button>
                  </div>
                </div>
            </form>

          </div>
        </div>


        <!-- close -->

@endsection

@push('scripts')

    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js?v=1.0') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-multiselect.min.js?v=1.0') }}"></script>
    <script>
        $(document).ready(function() {
            $('#equipments').multiselect({
                noneSelectedText: 'Select Something (required)',
                includeSelectAllOption: true,
                selectedList: 3,
            });
        });
    </script>


    <script src="{{ asset('assets/js/jquery.validate.min.js?v=1.0') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datepicker.min.js?v=1.0') }}"></script>
    <script>

        $(".close").click(function() {
                $('#updateDispatchModal').modal('hide');
        });

        $(".close4").click(function() {
                $('#updateDispatchModal').modal('hide');
        });


        function update_dispatch_date(pt_id = '') {

            $('.modalBox').modal('show');
            $("#pt_id").val(pt_id);

        }

            $(document).ready(function() {
                $(`.datepicker`).datepicker({ autoclose: true, format: 'yyyy-mm-dd',  startDate:'+0d' });
            });

            $("#institute_id").change(function() 
                {
                    let inst_id = $.trim($(this).val());
                    const { origin, pathname } = window.location;

                    if (inst_id)
                    window.location.href = `${origin}${pathname}?inst_id=${inst_id}`;
                     else
                    window.location.href = `${origin}${pathname}`;
                });

            /* code */

            let _token = $('meta[name="csrf-token"]').attr('content');

            $.validator.addMethod("needsSelection", function(value, element) {
                return $(element).find('option:selected').length > 0;
            });

            $.validator.addMethod("validatePdf", function(value, element) {
                var fileExtension = ['pdf'];
                return ($.inArray(value.split('.').pop().toLowerCase(), fileExtension) != -1)
            }, "Please select a valid file (PDF are allowed)");


            $("#update_dispatch_info").validate({
                    rules: {
                                dispatch_date: {
                                    required: true,
                                },

                                dispatch_pdf: {
                                    required: true,
                                    validatePdf: true
                                },

                            },
                    submitHandler: function(form) {

                        $("#update_dispatch_btn").attr('disabled', true).html('just a moment...');

                        let formdata = $(form).serialize();

                        let formData =  new FormData(form);

                        formData.append("_token", _token);

                        $.ajax({
                                    url: `{{ route('update-dispatch-info') }}`,
                                    type: "POST",    
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function(response) {
                                        if (response.status == true) {
                                            //pageLoad();
                                        }
                                    },
                                    error: function (jqXHR, exception) {
                                        $("#update_dispatch_btn").removeAttr('disabled').html('Update');
                                        alert('Something went wrong!');
                                    }
                             });
                        return false;
                    }
            });

            function pageLoad() {
              window.location.reload();
            }

            /* close */

    </script>
@endpush