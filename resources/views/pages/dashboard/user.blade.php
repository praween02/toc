@extends('layouts.app')
@section('title', ' - Dashboard')
@section('content')
<style>
.card-body label{color:#fff}
.spacer{line-height:28px}
h6{color:#fff;padding-left:10px;font-size:14px;letter-spacing:1px}
.card-body{padding-top:5px !important}
.card-body label{color:#f7f7f7}
.brder{border-radius:10px;background:#fff;padding:5px;box-shadow: 6px 11px 41px -28px #796eb1;-webkit-box-shadow: 6px 11px 41px -28px #796eb1;}
.hghtchart,#container{height:200px}
.card{box-shadow:0 0 10px #bebebe}
.txt-head{background:#2f316f;text-align:center;margin:0 auto;color:#fff;line-height:200px;font-weight:900;font-size:18px}
.txt-head a {color: #fff}
</style>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
                        <div class="container">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 float-left"><h2>{{ __('Dashboard') }}</h2></div>
                        </div><br />
                        <div class="row">
                         <div class="col-md-6 col-xl-4">
                            <div class="widget-rounded-circle card">
                               <!-- <h6>Lab Status</h6> -->
                                <div class="card-body brder">
                                     <div id="container" class="txt-head">
                                        <a href="{{ route('expert_user') }}" title="Apply For Expert">Apply For Expert</a>
                                     </div>
                                </div>
                            </div>
                            <!-- end widget-rounded-circle-->
                         </div>
                         <!-- end col-->
      
                         <!-- end col-->
                        <!-- end col-->
                         <div class="col-md-6 col-xl-4">
                            <div class="widget-rounded-circle card">
                               <!-- <h6>Projects</h6> -->
                                <div class="card-body brder">
                                    <div id="container" class="txt-head">
                                        <a href="{{ route('poc_bsnl') }}" title="Apply For BSNL POC">Apply For BSNL POC</a>
                                    </div>
                                </div>
                            </div>
                            <!-- end widget-rounded-circle-->
                         </div>
                         <!-- end col-->

                         <!-- end col-->
                         <div class="col-md-6 col-xl-4">
                            <div class="widget-rounded-circle card">
                               <!-- <h6>Use Case Verticle</h6> -->
                               <div class="card-body brder">
                                    <div id="container" class="txt-head">
                                        <a href="{{ route('six_g_user') }}" title="Apply For 6G Application">Apply For 6G Application</a>
                                    </div>
                                  <!-- end row-->
                               </div>
                            </div>
                            <!-- end widget-rounded-circle-->
                         </div>
                         <!-- end col-->

                    </div>
                </div>
            </div>
        <!-- End Content-->
    </div>
</div>
@endsection