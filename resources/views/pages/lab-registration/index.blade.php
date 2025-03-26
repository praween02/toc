@extends('layouts.app')
@section('title', ' - Lab Registration')
@section('content')
<style type="text/css">
.sml { font-size: 10px; font-style: italic; }
.table>:not(:last-child)>:last-child>* { width: 81px !important; }
</style>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 float-left"><h3>Lab Registration</h3></div>
                        <div class="col-md-6 text-end">
                            @if(in_array("vendor", get_roles()) OR in_array("institute", get_roles()))
                                <a href="{{ route('lab-registration.create') }}" class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0">
                                    <i class="fa fa-plus"></i> Add New Registration
                                </a>
                            @endif
                        </div>
                    </div>
                    
                    {{ $dataTable->table(['class' => 'table table-bordered']) }}
                </div>
            </div>
        </div>
        <!-- End Content-->
    </div>
</div>
@endsection

@push('scripts')
    @include('sections.datatable_js')
@endpush
