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
 .srch{border:1px solid #ddd;border-radius:3px;height:30px;line-height:30px;width:80px}
 table {
  table-layout:fixed; 
  width:100%;
}
td, th {
  vertical-align:top;
  padding:5px;
  width:100px;
  font-weight:normal;
  font-size:11px;
}
.fix {
  position: absolute;
  margin-left:-100px;
  width:100px;
  height:351px !important;
}
.outer {
  position: relative;
}
.inner {
  overflow-x:scroll;
  overflow-y:visible;
  width:87%; 
  margin-left:100px;
  min-height:400px;
  height:100%;
}
.mbox{border:1px solid #ddd;padding:5px;font-size:10px;border-radius:5px;margin-bottom:3px}
.tableFixHead {
  overflow: auto;
  height: 100px;
}

.tableFixHead thead th {
  position: sticky;
  top: 0;
}
.hght {
    font-size: 10px;
    padding: 3px 7px !important;
    font-weight: normal !important;
    line-height: 10px;
    height: 18px;
}
  th{background-color:#2f316f;color:#fff}
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

                                    <div class="card-body">
                                        <div class="mb-3">
                                            <div class="row">
                                                <p style="color:#a29105;letter-spacing:0.5px">Please select zone and institute to view the project timeline!</p>
                                                <div class="form-group" style="width:20%">
                                                    <label>Select Zone</label>
                                                    <select name="zone" id="zone" class="form-control" onchange="sel_zone(this.value)">
                                                        <option value="">-- Select --</option>
                                                        @foreach($zones as $zone)
                                                            <option {{ Request::get('zone_id') == $zone->id ? "selected" : "" }} value="{{ $zone->id }}">{{ $zone->zone }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group" style="width:75%">
                                                    <label>Select Institute</label>
                                                    <select name="institute" id="institute" class="form-control" onchange="sel_institute(this.value)">
                                                        <option value="">-- Select --</option>
                                                        @foreach($institutes as $institute)
                                                            <option {{ Request::get('inst_id') == $institute->id ? "selected" : "" }} value="{{ $institute->id }}">{{ $institute->institute }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="table table-responsive">
                                                <table id="timelines_show">
                                                    <thead>
                                                        <tr>
                                                            <th>Equipment</th>
                                                            <th>Delivery Info</th>
                                                            <th>Installation Info</th>
                                                            <th>Commission Info</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($equipments as $equipment)
                                                      <tr>
                                                            <td>{{ $equipment->equipment }}</th>
                                                            <td>
                                                               <p>Dispatch Date: <span class="badge btn-danger hght">{!! (! empty($response[$equipment->id]['equipment_dispatch_date'])) ? (date("D, j M'y", strtotime($response[$equipment->id]['equipment_dispatch_date']))) : 'N/A' !!}</span></p>

                                                               <p>Actual Dispatch Date: <span class="badge btn-danger hght">{!! (! empty($response[$equipment->id]['equipment_actual_dispatch_date'])) ? (date("D, j M'y", strtotime($response[$equipment->id]['equipment_actual_dispatch_date']))) : 'N/A' !!}</span></p>

                                                               <p>Delivery Date: <span class="badge btn-success hght">{!! (! empty($response[$equipment->id]['equipment_delivery_date'])) ? date("D, j M'y", strtotime($response[$equipment->id]['equipment_delivery_date'])) : 'N/A' !!}</span></p>
                                                            </td>

                                                            <td>
                                                               <p>Installation date: <span class="badge btn-danger hght">
                                                                {!! (! empty($response[$equipment->id]['equipment_install_date'])) ? date("D, j M'y", strtotime($response[$equipment->id]['equipment_install_date'])) :  "N/A" !!} 
                                                               </p>

                                                               <p>Installed date: <span class="badge btn-success hght">
                                                                {!! (! empty($response[$equipment->id]['equipment_installed_date'])) ? date("D, j M'y", strtotime($response[$equipment->id]['equipment_installed_date'])) :  'N/A' !!}</span>
                                                               </p>
                                                            </td>

                                                            <td>
                                                               <p>Commission date: <span class="badge btn-danger hght">{!! (! empty($response[$equipment->id]['equipment_commision_date'])) ? date("D, j M'y", strtotime($response[$equipment->id]['equipment_commision_date']))  : 'N/A' !!}
                                                               </p>
                                                               
                                                               <p>Commissioned date: <span class="badge btn-success hght">{!! (! empty($response[$equipment->id]['equipment_commisioned_date'])) ? date("D, j M'y", strtotime($response[$equipment->id]['equipment_commisioned_date'])) :  'N/A' !!}
                                                               </p>
                                                            </td>

                                                          </td>
                                                      </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                
                                </div> <!-- end card-body -->

                        </div> <!-- end card-->
                    </div> <!-- end col -->
                    <!-- end row -->
                    
                </div> <!-- container -->
            </div> <!-- content -->
        </div>
@endsection

@push('scripts')
 <script src="{{ asset('assets/js/bootstrap-datepicker.min.js?v=1.0') }}"></script>
    <script>

        function sel_zone(val) {
            const {origin, pathname} = window.location;
            window.location.href = `${origin}${pathname}?zone_id=${val}`;
        }

        function sel_institute(val) {
            let zone_id = $("select#zone option:selected").val();
            if (val) {
                const {origin, pathname} = window.location;
                window.location.href = `${origin}${pathname}?zone_id=${zone_id}&inst_id=${val}`;
            } else {
                window.location.href = `${origin}${pathname}?zone_id=${zone_id}`;
            }
        }


        $("#srch").on("keyup", function() 
            {
                let searchText = $(this).val().toLowerCase();
                if (searchText == "") {
                    $("table#timelines_show tbody tr").show();  
                    return;  
                }
                $("table#timelines_show tbody tr").each(function(index) {
                    let equipment = $(this).find("th").text();
                    (equipment.toLowerCase().includes(searchText)) ? $(this).show() : $(this).hide();
                });
            });

        function inst(inst_id) {
            const { origin, pathname } = window.location;
            location.href = `${origin}${pathname}?inst_id=${inst_id}`;
        }

        $(document).ready(function() {
                $(`.datepicker`).datepicker({ autoclose: true, format: 'yyyy-mm-dd'});
        });

    </script>
@endpush