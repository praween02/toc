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

                    <!-- Form row -->

                    @if($ticket->status != "closed")
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <form method="POST" id="update-ticket-data-form" action="{{ route('tickets.update', $ticket->ticket_no) }}">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3">
                                            <p><span class="req">*</span> = required fields</p>
                                        </div>

                                        @php
                                            $onchange = '';
                                            if(in_array('vendor', get_roles()))
                                            $onchange = "onchange=sel_subject(this.value)";
                                        @endphp


                                        <!-- <div class="mb-3">
                                            <label for="subject" class="form-label">{{ __('Subject') }} <span class="req">*</span></label>
                                            <select name="subject" autocomplete="off" class="form-control" id="subject" placeholder="{{ __('placeholder.subject') }}" {{ $onchange }}>
                                                 <option value="">-- Select --</option>
                                                 <option value="equipment_related" {{ $ticket->subject == "equipment_related" ? "selected" : "" }}>Equipment related</option>
                                                 <option value="others" {{ $ticket->subject == "others" ? "selected" : "" }}>Others</option>
                                            </select>

                                            @if($errors->has('subject'))
                                                <p class="req">{{ $errors->first('subject') }}</p>
                                            @endif

                                        </div>
 -->
                                        @if(in_array('vendor', get_roles()))

                                        <!-- <div class="mb-3 {{ $ticket->subject == 'equipment_related' ? '' : 'd-none' }}" id="equipment_box">
                                            <label for="institute" class="form-label">{{ __('Institute') }} <span class="req">*</span></label>
                                            <select name="institute" autocomplete="off" class="form-control" id="institute" placeholder="{{ __('placeholder.institute') }}">
                                                @foreach($institutes as $institute)
                                                <option {{ ($ticket->institute == $institute->id ? 'selected' : '') }} value="{{ $institute->id }}">{{ $institute->institute }}</option>
                                                @endforeach
                                            </select>

                                            @if($errors->has('institute'))
                                                <p class="req">{{ $errors->first('institute') }}</p>
                                            @endif

                                        </div> -->
                                        
                                        @endif


                                        <div class="mb-3">
                                            <label for="description" class="form-label">{{ __('Description') }} <span class="req">*</span></label>
                                            <textarea style="height:200px" name="description" autocomplete="off" class="form-control" id="description" placeholder="{{ __('placeholder.description') }}">{!! $ticket->description !!}</textarea>

                                            @if($errors->has('description'))
                                                <p class="req">{{ $errors->first('description') }}</p>
                                            @endif

                                        </div>

                                        @if(current_user_id() == $ticket->user_id)
                                        <div class="mb-3">
                                            <label for="status" class="form-label">{{ __('Status') }} <span class="req">*</span></label>
                                            <select name="status" class="form-control">
                                                <option value="open" {{ $ticket->status == "open" ? "selected" : ""  }}>Open</option>
                                                <option value="in-progress" {{ $ticket->status == "in-progress" ? "selected" : ""  }}>In-Progress</option>
                                                <option value="closed" {{ $ticket->status == "closed" ? "selected" : ""  }}>Closed</option>
                                            </select>

                                            @if($errors->has('status'))
                                                <p class="req">{{ $errors->first('status') }}</p>
                                            @endif

                                        </div>
                                        @endif

                                        <button type="submit" class="btn btn-primary waves-effect waves-light"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send feather-sm fill-white me-2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>Submit</button>

                                    </form>


                                </div> <!-- end card-body -->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                    @endif


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