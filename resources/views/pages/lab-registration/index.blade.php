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
                        <div class="col-md-6 float-left"><h3>{{ __('app.lab_registration') }}</h3></div>
                    </div>
                    
                    {{ $dataTable->table(['class' => 'table table-bordered']) }}
                </div>
            </div>
        </div>
        <!-- End Content-->
    </div>
</div>
<!-- Reject With Reason Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form id="rejectForm" method="POST" action="{{ route('lab-registration.reject') }}">
        @csrf
        <input type="hidden" name="id" id="reject_id">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="rejectModalLabel">Reject Reason</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="reason">Please enter the reason for rejection:</label>
              <textarea name="reason" id="reason" class="form-control" rows="3" required></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  
@endsection

@push('scripts')
<script>
    // Function to open the modal and set the registration ID
    function rejectWithReason(id) {
      // Set the hidden input value
      $('#reject_id').val(id);
      // Clear any previous text in the textarea (optional)
      $('#reason').val('');
      // Open the modal
      $('#rejectModal').modal('show');
    }
  
    // Handle the rejection form submission
    $('#rejectForm').on('submit', function(e) {
      e.preventDefault(); // prevent default form submission
  
      $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
          // Optionally, show a success message or update the table row's status
          $('#rejectModal').modal('hide');
          // For example, reload the page or the datatable
          location.reload();
        },
        error: function(xhr) {
          // Handle errors here (display error message, etc.)
          alert('Error: ' + xhr.responseText);
        }
      });
    });
  </script>
  
    @include('sections.datatable_js')
@endpush
