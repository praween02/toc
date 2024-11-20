@extends('layouts.app')
@section('title', ' - Edit Ticket')
@section('content')
<style>
    .ck-editor__editable {
    min-height:150px;
}
.be-comment-content span {
    display: inline-block;
    width: 49%;
    margin-bottom: 15px;
}

.be-comment-content span {
    display: inline-block;
    width: 49%;
    margin-bottom: 15px;
}

.be-comment-text {
    font-size: 13px;
    line-height: 18px;
    color: #7a8192;
    display: block;
    background: #f6f6f7;
    border: 1px solid #edeff2;
    padding:10px;
border-radius:5px;
line-height:20px;
}
.commentsection {
border: 1px dashed #d4d1d1;
border-radius: 10px;
padding: 10px;
margin: 3px 0 10px 3px;
}

.txt-right{text-align:right}
</style>
        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Ticket No - {{ $ticket->ticket_no }}</h4>
                                <h4 class="page-title">Status -  {!! ($ticket->status == 'open' ? ("<span class='badge btn-info'>Open</span>") : (($ticket->status == 'in-progress') ? "<span class='badge btn-secondary'>In Progress</span>" : "<span class='badge btn-success'>Closed</span>")) !!}</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">

                            @forelse($comments as $comment)
                            <div class="be-comment-content commentsection">
                               <span class="be-comment-name"> {{ ucwords($comment->name) }} </span> 
                               <span class="be-comment-time txt-right"> <i class="fa fa-clock-o"></i> {{ date('D, j M\'y h:i A', strtotime($comment->created_at)) }} </span>
                               <div class="be-comment-text"> {!! $comment->message !!}</div>
                            </div>
                            @empty
                            @endforelse


                        </div>

                    </div>

                </div> <!-- container -->
            </div> <!-- content -->
        </div>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/ckeditor.js?v=40.2.0') }}"></script>
<script>
    function check_all(ths, cls) {
        $(`.${cls}`).prop('checked', ths.checked);
    }

    ClassicEditor
        .create(document.querySelector('#description'))
        .catch( error => {
            console.error(error);
        });

    function sel_subject(val) {

        if (val == "equipment_related") {
            $("#equipment_box").removeClass('d-none');
        } else {
            $("#equipment_box").addClass('d-none');
        }
    }
</script>
@endpush
