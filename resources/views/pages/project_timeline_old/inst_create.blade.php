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

                                <form id="project_timeline" method="POST" enctype="multipart/form-data">
                                  @csrf
                                    <div class="card-body">

                                        <div class="col-12">
                                            <p><strong>Select Equipments</strong> <span class="req">*</span></p>
                                            <p>
                                                <select name="equipments" class="form-control" id="equipments" multiple>
                                                    @foreach ($equipments as $equipment)
                                                        <option value="{{ \Illuminate\Support\Facades\Crypt::encrypt($equipment->id) }}">{{ $equipment->equipment }}</option>
                                                    @endforeach
                                                </select>

                                                @if($errors->has('equipment_id'))
                                                    <p class="req">{{ $errors->first('equipment_id') }}</p>
                                                @endif
                                            </p>
                                        </div>

                                        <div class="row mt-3 schedule_timelines d-none">
                                            <div class="col-3">
                                                <p><strong><span class="label">Delivered Date</span></strong> <span class="req">*</span></p>
                                                <p>
                                                    <input autocomplete="off" type="text" name="delivered_date" value="{{ date("Y-m-d") }}" class="form-control datepicker" id="" placeholder="Delivered Date" /> 
                                                    @if($errors->has('delivered_date'))
                                                        <p class="req">{{ $errors->first('delivered_date') }}</p>
                                                    @endif
                                                </p>
                                            </div>
                                            
                                            <div class="col-3">
                                                <p><strong><span class="label">Installed Date</span></strong> <span class="req">*</span></p>
                                                <p>
                                                    <input autocomplete="off" type="text" name="installed_date" value="{{ date("Y-m-d") }}" placeholder="Installed Date" class="form-control datepicker" id="" /> 
                                                    @if($errors->has('installed_date'))
                                                        <p class="req">{{ $errors->first('installed_date') }}</p>
                                                    @endif
                                                </p>
                                            </div>

                                            <div class="col-3">
                                                <p><strong><span class="label">Commissioned Date</span></strong> <span class="req">*</span></p>
                                                <p>
                                                    <input autocomplete="off" type="text" name="commissioned_date" value="{{ date("Y-m-d") }}" class="form-control datepicker" id=""  placeholder="Commissioned Date"/> 
                                                    @if($errors->has('commissioned_date'))
                                                        <p class="req">{{ $errors->first('commissioned_date') }}</p>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button type="submit" disabled id="btnsbmt" class="btn btn-primary waves-effect waves-light"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send feather-sm fill-white me-2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>Submit</button>
                                        </div>


                                        <div class="col-12 mt-3" id="prefilled_data">
                                        </div>

                                
                                    </div> <!-- end card-body -->

                                </form>

                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->
                    
                </div> <!-- container -->
            </div> <!-- content -->
        </div>

        <!-- modal -->

        <div class="modal modalBox" tabindex="-1" role="dialog">
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
            // function inst(inst_id) {
            //     const { origin, pathname } = window.location;
            //     location.href = `${origin}${pathname}?inst_id=${inst_id}`;
            // }

            $(document).ready(function() {
                $(`.datepicker`).datepicker({ autoclose: true, format: 'yyyy-mm-dd'});
            });

            /* code */

            $("#equipments").change(function() {
                checkProjectTimeline();
            });

            let _token = $('meta[name="csrf-token"]').attr('content');

            function checkProjectTimeline() {
                let equipments = $("#equipments").val();
                let equipments_length = parseInt(equipments.length);

                $("#btnsbmt").attr('disabled', true);   
                $(".schedule_timelines").addClass('d-none');

                if (equipments_length)
                    {   
                        $.ajax({
                                    url: `{{ route('check-inst-equipments-project-timeline') }}`,
                                    type: "POST",    
                                    data: {equipments, _token},
                                    dataType: 'json',
                                    success: function(response) 
                                        {
                                            const { actual_dispatch_count } =  response.result;
                                            if (actual_dispatch_count == equipments_length) 
                                                {
                                                    $(".schedule_timelines").removeClass('d-none');
                                                    $("#btnsbmt").removeAttr('disabled');                  
                                                }
                                            else 
                                                {
                                                    $('.modalTitle').html('Warning');
                                                    $('#modalMsg').html('Please select, unselect the equipments to delivered, installed & commissioned date');
                                                    $(".modalBox").modal('show');
                                                }
                                        }
                              });
                    }
            }

            $.validator.addMethod("needsSelection", function(value, element) {
                return $(element).find('option:selected').length > 0;
            });

            $.validator.addMethod("validatePdf", function(value, element) {
                var fileExtension = ['pdf'];
                return ($.inArray(value.split('.').pop().toLowerCase(), fileExtension) != -1)
            }, "Please select a valid file (PDF are allowed)");

            $("#project_timeline").validate({
                    rules: {
                        equipments: "required needsSelection",
                        delivered_date: "required",
                        installed_date: "required",
                        commissioned_date: "required",
                    },
                    ignore: ':hidden:not("#equipments")',
                    submitHandler: function(form) {

                        $("#btnsbmt").attr('disabled', true);

                        let formdata = $(form).serialize();
                        let equipments = $("#equipments").val();

                        let formData =  new FormData(form);
                        formData.append("equipments", equipments);
                        formData.append("_token", _token);
                        $.ajax({
                                    url: `{{ route('inst_equipment_data') }}`,
                                    type: "POST",    
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function(response) {
                                        if (response.status == "success") {
                                            $('.modalTitle').html('Success');
                                            $('#modalMsg').html('Saved Successfully');
                                            $(".modalBox").modal('show');
                                        }
                                        setTimeout(pageLoad, 1000);
                                    },
                                    error: function (jqXHR, exception) {
                                        $("#btnsbmt").removeAttr('disabled');
                                        $('.modalTitle').html('Error');
                                        $('#modalMsg').html('Something went wrong!');
                                        $(".modalBox").modal('show');
                                    }
                             });

                        return false;
                    }
            });

            function pageLoad() {
              window.location.reload();
            }

            /* close */


            // function inst(inst_id)
            //  {
            //     populatePrefilledData();
            //  }

            // function sel_type(val) {

            //         $(".dt_box").removeClass('d-none');

            //         switch(val)
            //             {
            //                 case 'Delivery_Date':
            //                                         $('.label').html('Delivery Date');
            //                                         break;
            //                 case 'Installation_Date':
            //                                         $('.label').html('Installation Date');
            //                                         break;
            //                 case 'Commission_Date':
            //                                         $('.label').html('Commission Date');
            //                                         break;
            //                 case 'Dispatch_Invoice':
            //                                         $('.label').html('Dispatch Date');
            //                                         break;
            //                 default:
            //                                         $('.label').html('');
            //                                         $(".dt_box").addClass('d-none');
            //                                         break;
            //             }

            //         populatePrefilledData();
            // }

            // function populatePrefilledData()
            //     {
            //         let inst_id = $("select#institute_id option:selected").val();
            //         let type = $("select#type option:selected").val();

            //         if (inst_id && type)
            //              {
            //                 $("#prefilled_data").html('<p>Loading....</p>');
            //                 $.ajax({
            //                             url: `{{ route('prefilled_equipment_data') }}?inst_id=${inst_id}&type=${type}`,
            //                             type: "GET",    
            //                             data: {},
            //                             success: function(response) {

            //                                 let html = `<table class="table tbl">
            //                                                   <thead>
            //                                                     <tr>
            //                                                       <th scope="col">#</th>
            //                                                       <th scope="col">Equipment</th>
            //                                                       <th scope="col">${type.replace("_", " ")}</th>
            //                                                     </tr>
            //                                                   </thead>
            //                                                   <tbody>`;


            //                                 if(response.results.length > 0) 
            //                                     {
            //                                         let i = 0;
            //                                         $.each(response.results, function (a, b ) 
            //                                             {
            //                                                 i += 1;
            //                                                 html += `<tr>
            //                                                           <td scope="row">${i}</td>
            //                                                           <td>${b.equipments}</td>
            //                                                           <td>${b.field}</td>
            //                                                         </tr>`;
            //                                             })
            //                                     } 
            //                                 else 
            //                                     {
            //                                            html += `<tr>
            //                                                         <td colspan='3'>No Data!</td>
            //                                                     </tr>`;
            //                                     }
            //                                         html += '</tbody></table>';

            //                                         $("#prefilled_data").html(html);
                                           
            //                             },
            //                             error: function() {
            //                                 $("#prefilled_data").html('<p>Something went wrong!!');
            //                             }    
            //                         });
            //              }    
            //     }


            // $.validator.addMethod("needsSelection", function(value, element) {
            //     return $(element).find('option:selected').length > 0;
            // });

            // $.validator.messages.needsSelection = 'You gotta pick something.';

            // $("#project_timeline").validate({
            //         rules: {
            //             institute_id: "required",
            //             //type: "required",
            //             equipments: "required needsSelection"
            //         },
            //         ignore: ':hidden:not("#equipments")',
            //         submitHandler: function(form) {
            //             console.log($("#equipments").val());
            //             return false;
            //         }
            // });



            // $("#equipments").change(function() {
            //     console.log($("#equipments").val());
            // });

            // $("#srch").on("keyup", function() 
            //     {
            //             let searchText = $(this).val().toLowerCase();

            //             if (searchText == "") {
            //                 $("table#project_timeline tr").show();  
            //                 return;  
            //             }

            //             $("table#project_timeline tr").each(function(index) {
            //                 if (index != 0) {
            //                     let equipment = $(this).find("td:eq(1)").text();
            //                     (equipment.toLowerCase().includes(searchText)) ? $(this).show() : $(this).hide();
            //                 }
            //             });
            //     });


    </script>
@endpush
