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

                                <h4 class="page-title"><small><label style="color:#2f316f">{{ __('app.vendor') }}:</label> {{ $vendor_name }}</small></h4>
                                <h4 class="page-title"><small><label style="color:#2f316f">{{ __('app.institute') }}:</label> {{ $inst_name }}</small></h4>
                            </div>
                        </div>
                    </div>     
                    <!-- end page title --> 


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4>Scheduled Equipments List</h4>
                                    <div id="schedule_equipments">
                                            <table class="table table-bordered dataTable">
                                              <thead>
                                                <tr>
                                                  <th scope="col">#</th>
                                                  <th scope="col">Equipment</th>
                                                  <th scope="col">Dispatch Date</th>
                                                  <th scope="col">Dispatch Pdf</th>
                                                  <th scope="col">Delivery Date</th>
                                                  <th scope="col">Installation Date</th>
                                                  <th scope="col">Commission Date</th>
                                                  <th scope="col">Upload Doc</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                @forelse($schedule_equipments as $equipment)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $equipment->equipment }}</td>
                                                    <td>
                                                        @if($equipment->equipment_dispatch_date)
                                                            <div class="box"><strong>Scheduled</strong> [{{ date('D, j M\'y', strtotime($equipment->equipment_dispatch_date)) }}]</div> 
                                                            @if(empty($equipment->equipment_actual_dispatch_date))
                                                                <button style="display:none" type="button" class="btn btn-info btn-xs btstrp_model" style="padding:3px 5px;font-size:10px;" onclick="showModal('{{  \Illuminate\Support\Facades\Crypt::encrypt($equipment->pt_id) }}', '{{ $equipment->equipment_delivery_date }}')">Approve</button>
                                                            @else
                                                                <div class="box"><strong>Actual Dispatch Date:</strong> [{{ date('D, j M\'y', strtotime($equipment->equipment_actual_dispatch_date)) }}] </div>
                                                            @endif
                                                        @else
                                                            <span>N/A</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($equipment->dispatch_invoice_file)
                                                            <a target="_blank" download href="{{ url('storage/uploads/' . $equipment->dispatch_invoice_file) }}"><i class="fa fa-pdf"></i> {{ $equipment->dispatch_invoice_file }}</a>
                                                        @else
                                                            <span>N/A</span>
                                                        @endif

                                                    </td>
                                                    <td>
                                                        <div class="box"><strong>Scheduled Delivery:</strong> {{ date('D, j M\'y', strtotime($equipment->equipment_delivery_date)) }}</div>

                                                        @if(empty($equipment->equipment_delivered_date))
                                                             <button type="button" class="btn btn-info btn-xs btstrp_model" style="padding:3px 5px;font-size:10px;" onclick="showActionModal('{{  \Illuminate\Support\Facades\Crypt::encrypt($equipment->pt_id) }}', 1, '{{ $equipment->equipment_delivery_date }}')">Approve</button>
                                                        @else
                                                        <div class="box"><strong>Delivered:</strong> {{ date('D, j M\'y', strtotime($equipment->equipment_delivered_date)) }}</div>
                                                        @endif

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
                                                              echo '<div class="box">No of days delayed: <strong>' . round(($date2 - $date1) / (60 * 60 * 24)). '</strong></p>';
                                                        }                                            
                                                        @endphp


                                                    </td>
                                                    <td>
                                                        <div class="box"><strong>Scheduled Install:</strong>  {!! (! empty($equipment->equipment_install_date) ? date("D, j M'y", strtotime($equipment->equipment_install_date)) :  'N/A') !!} </div>
                                                        @if(empty($equipment->equipment_installed_date) && ( ! empty($equipment->equipment_delivered_date)))
                                                             <button type="button" class="btn btn-info btn-xs btstrp_model" style="padding:3px 5px;font-size:10px;" onclick="showActionModal('{{  \Illuminate\Support\Facades\Crypt::encrypt($equipment->pt_id) }}', 2, '{{ $equipment->equipment_install_date }}')">Approve</button>
                                                        @else
                                                        <div class="box"><strong>Installed:</strong> {!! (! empty($equipment->equipment_installed_date) ? date("D, j M'y", strtotime($equipment->equipment_installed_date)) :  'N/A') !!} </div>
                                                        @endif


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
                                                              echo '<div class="box">No of days delayed: <strong>' . round(($date2 - $date1) / (60 * 60 * 24)). '</strong></p>';
                                                        }                                            
                                                        @endphp

                                                    </td>
                                                    <td>
                                                        <div class="box"><strong>Scheduled Commission:</strong> 

                                                        {!! (! empty($equipment->equipment_commision_date) ? date("D, j M'y", strtotime($equipment->equipment_commision_date)) :  'N/A') !!}

                                                    </div>
                                                        @if(empty($equipment->equipment_commisioned_date) && ( ! empty($equipment->equipment_installed_date)))
                                                             <button type="button" class="btn btn-info btn-xs btstrp_model" style="padding:3px 5px;font-size:10px;" onclick="showActionModal('{{  \Illuminate\Support\Facades\Crypt::encrypt($equipment->pt_id) }}', 3, '{{ $equipment->equipment_commision_date }}')">Approve</button>
                                                        @else
                                                        <div class="box"><strong>Commissioned:</strong> {!! (! empty($equipment->equipment_commisioned_date) ? date("D, j M'y", strtotime($equipment->equipment_commisioned_date)) :  'N/A') !!} </div>
                                                        @endif

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
                                                              echo '<br/><p>No of days delayed: <strong>' . round(($date2 - $date1) / (60 * 60 * 24)). '</strong></p>';
                                                        }                                            
                                                        @endphp

                                                    </td>
                                                    <td>

                                                        @if(empty($equipment->upload_pdf))
                                                                <button type="button" class="btn btn-info btn-xs btstrp_model" style="padding:3px 5px;font-size:10px;" onclick="showUploadModal('{{  \Illuminate\Support\Facades\Crypt::encrypt($equipment->pt_id) }}')">Upload</button>
                                                        @else
                                                                <a target="_blank" download href="{{ url('storage/uploads/' . $equipment->upload_pdf) }}"><i class="fa fa-pdf"></i> {{ $equipment->upload_pdf }}</a>
                                                        @endif

                                                        </td>
                                                 </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="7">No any scheduled equipments</td>
                                                    </tr>
                                                @endforelse
                                              </tbody>
                                            </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                    
                </div> <!-- container -->
            </div> <!-- content -->
        </div>

        <!-- modal -->

        <div class="modal modalBoxDiv" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <form id="project_timeline" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Update Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                          <div class="form-group">
                            <label for="actual_dispatch_date">Actual Disptach Date <span class="req">*</span></label>
                            <input  type="text" class="datepicker form-control mt-2" id="actual_dispatch_date" name="actual_dispatch_date" placeholder="Actual Disptach Date" autocomplete="off" required />
                            <input type="hidden" name="schedule_id" id="schedule_id" value="" />
                          </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" id="btnsbmt" class="btn btn-primary">Update</button>
                  </div>
                </div>
            </form>
          </div>
        </div>

        <!-- close -->


        <!-- POP UP -->


        <div class="modal modalActionBoxDiv" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <form id="project_timeline_actions" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Update Information</h5>
                    <button type="button" class="close1" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                          <div class="form-group" id="delivered_date_box">
                            <label for="actual_dispatch_date">Delivered Date <span class="req">*</span></label>
                            <input  type="text" class="datepicker form-control mt-2" id="delivered_date" name="delivered_date" placeholder="Delivered Date" autocomplete="off" />
                          </div>

                          <div class="form-group" id="installed_date_box">
                            <label for="actual_dispatch_date">Installed Date <span class="req">*</span></label>
                            <input  type="text" class="datepicker form-control mt-2" id="installed_date" name="installed_date" placeholder="Installed Date" autocomplete="off" />
                          </div>

                          <div class="form-group" id="commissioned_date_box">
                            <label for="actual_dispatch_date">Commissioned Date <span class="req">*</span></label>
                            <input  type="text" class="datepicker form-control mt-2" id="commissioned_date" name="commissioned_date" placeholder="Commissioned Date" autocomplete="off" />
                          </div>

                          <input type="hidden" name="pro_time_id" id="pro_time_id" value="" />
                          <input type="hidden" name="p_action_id" id="p_action_id" value="" />
                  </div>
                  <div class="modal-footer">
                    <button type="submit" id="btnsbmt1" class="btn btn-primary">Update</button>
                  </div>
                </div>
            </form>
          </div>
        </div>

        <!-- close -->

        <!-- modal -->

        <div class="modal modalUploadBoxDiv" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <form id="project_timeline_upload" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Upload File</h5>
                    <button type="button" class="close4" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                          <div class="form-group">
                            <label for="actual_dispatch_date">Upload PDF <span class="req">*</span></label>
                            <input accept="application/pdf"  type="file" class="form-control mt-2" id="file" name="upload_pdf" placeholder="Upload PDF" autocomplete="off" />
                            <input type="hidden" name="ptl_id" id="ptl_id" value="" />
                          </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" id="btnsbmt2" class="btn btn-primary">Submit</button>
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

        function showModal(v, d) {
                $("#schedule_id").val(v);
                $('.modalBoxDiv').modal('show');
                $(`.datepicker`).datepicker({ startDate: d });
        }


        $(".close4").click(function() {
                $('.modalUploadBoxDiv').modal('hide');
        });

        function showUploadModal(v) {
            $("#ptl_id").val(v);
            $('.modalUploadBoxDiv').modal('show');
        }
        
        $(".close").click(function() {
                $('.modalBoxDiv').modal('hide');
        });

        $(".close1").click(function() {
                $('.modalActionBoxDiv').modal('hide');
        });

        $(".close2").click(function() {
                $('.modalUploadBoxDiv').modal('hide');
        });

        function showActionModal(v, f, d) {
            $("#delivered_date_box,#installed_date_box,#commissioned_date_box").css('display', 'none');
            $("#p_action_id").val(f);
            switch(f) {
                case 1:
                        $('#delivered_date_box').css('display', '');
                        break;
                case 2:
                        $('#installed_date_box').css('display', '');
                        break;

                case 3:
                        $('#commissioned_date_box').css('display', '');
                        break;
            }
            $("#pro_time_id").val(v);
            $('.modalActionBoxDiv').modal('show');
            $(`.datepicker`).datepicker({ autoclose: true, format: 'yyyy-mm-dd', startDate: new Date(d)});
        }

    </script>

    <script src="{{ asset('assets/js/jquery.validate.min.js?v=1.0') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datepicker.min.js?v=1.0') }}"></script>
    <script>

            $(document).ready(function() {
                //$(`.datepicker`).datepicker({ autoclose: true, format: 'yyyy-mm-dd', startDate:'+0d'});
            });

            $.validator.addMethod("validatePdf", function(value, element) {
                var fileExtension = ['pdf'];
                return ($.inArray(value.split('.').pop().toLowerCase(), fileExtension) != -1)
            }, "Please select a valid file (PDF are allowed)");

            /* code */

            $("#project_timeline").validate({
                    rules: {
                        actual_dispatch_date: "required",
                    },
                    submitHandler: function(form) {

                        $("#btnsbmt").attr('disabled', true).html('just a moment...');

                        let formdata = $(form).serialize();
                        let equipments = $("#equipments").val();
                        let formData =  new FormData(form);
                        $.ajax({
                                    url: `{{ route('update-scheduled-equipment') }}`,
                                    type: "POST",    
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function(response) {
                                        window.location.reload();
                                    },
                                    error: function (jqXHR, exception) {
                                        $("#btnsbmt").removeAttr('disabled').html('Update');
                                        alert('Something went wrong!');
                                    }
                             });

                        return false;
                    }
            });


            let _token = $('meta[name="csrf-token"]').attr('content');

            $("#project_timeline_actions").validate({
                    rules: {

                        delivered_date: {
                                required: function () {
                                    return ($("#p_action_id").val() == 1);
                                }
                        },
                        installed_date: {
                                required: function () {
                                    return ($("#p_action_id").val() == 2);
                                }
                        },
                        commissioned_date: {
                                required: function () {
                                    return ($("#p_action_id").val() == 3);
                                }
                        },

                    },
                    submitHandler: function(form) {

                        $("#btnsbmt1").attr('disabled', true).html('just a moment...');

                        let formData =  new FormData(form);

                        formData.append("_token", _token);

                        $.ajax({
                                    url: `{{ route('update-scheduled-equipment-action') }}`,
                                    type: "POST",    
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function(response) {
                                        if (response.status == true) {
                                            window.location.reload();
                                        } else {
                                             alert('Something went wrong!');
                                        }
                                        
                                    },
                                    error: function (jqXHR, exception) {
                                        $("#btnsbmt1").removeAttr('disabled').html('Update');
                                       
                                    }
                             });

                        return false;
                    }
            });


            $("#project_timeline_upload").validate({
                    rules: {

                        upload_pdf: {
                                        required: true,
                                        validatePdf: true
                                },
                    },
                    submitHandler: function(form) {

                        $("#btnsbmt2").attr('disabled', true).html('just a moment...');

                        let formData =  new FormData(form);

                        formData.append("_token", _token);

                        $.ajax({
                                    url: `{{ route('update-scheduled-equipment-upload') }}`,
                                    type: "POST",    
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function(response) {
                                        if (response.status == true) {
                                            window.location.reload();
                                        } else {
                                             alert('Something went wrong!');
                                        }
                                        
                                    },
                                    error: function (jqXHR, exception) {
                                        $("#btnsbmt2").removeAttr('disabled').html('Update');
                                       
                                    }
                             });

                        return false;
                    }
            });


            /* close */

    </script>
@endpush