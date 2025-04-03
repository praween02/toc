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

    // Function to handle approval
    function approve(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to approve this registration?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, approve it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("lab-registration.approve") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Approved!',
                                'Registration has been approved successfully.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                response.message || 'Something went wrong.',
                                'error'
                            );
                        }
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            'Something went wrong. Please try again.',
                            'error'
                        );
                    }
                });
            }
        });
    }
  
    // Handle the rejection form submission
    $('#rejectForm').on('submit', function(e) {
      e.preventDefault(); // prevent default form submission
  
      $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
          $('#rejectModal').modal('hide');
          Swal.fire(
              'Rejected!',
              'Registration has been rejected successfully.',
              'success'
          ).then(() => {
              location.reload();
          });
        },
        error: function(xhr) {
          Swal.fire(
              'Error!',
              'Something went wrong. Please try again.',
              'error'
          );
        }
      });
    });
</script>
  
    @include('sections.datatable_js')
@endpush
