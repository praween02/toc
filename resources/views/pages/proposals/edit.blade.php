@extends('layouts.app')
@section('title', 'Edit Proposal')

@php
use Illuminate\Support\Facades\Auth;
use App\Models\UserInstitute;
use App\Models\VendorInstitute;
use App\Models\Institute;
@endphp

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h3>Edit Proposal</h3>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{ route('proposals.show', $proposal) }}" class="btn btn-secondary">
                                <i class="fa fa-arrow-left"></i> Back to Proposal
                            </a>
                        </div>
                    </div>

                    <form action="{{ route('proposals.update', $proposal) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="stack_holder" class="form-label">Stakeholders</label>
                            <select class="form-control @error('stack_holder') is-invalid @enderror" 
                                id="stack_holder" name="stack_holder" required>
                                <option value="">Select Stakeholder</option>
                                <option value="Students" {{ old('stack_holder', $proposal->stack_holder) == 'Students' ? 'selected' : '' }}>Students</option>
                                <option value="Faculties" {{ old('stack_holder', $proposal->stack_holder) == 'Faculties' ? 'selected' : '' }}>Faculties</option>
                                <option value="Startups" {{ old('stack_holder', $proposal->stack_holder) == 'Startups' ? 'selected' : '' }}>Startups</option>
                                <option value="MSME" {{ old('stack_holder', $proposal->stack_holder) == 'MSME' ? 'selected' : '' }}>MSME</option>
                                <option value="Enterprise" {{ old('stack_holder', $proposal->stack_holder) == 'Enterprise' ? 'selected' : '' }}>Enterprise</option>
                            </select>
                            @error('stack_holder')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="socio_economic_vertical" class="form-label">Socio-Economic Verticals</label>
                            <select class="form-control @error('socio_economic_vertical') is-invalid @enderror" 
                                id="socio_economic_vertical" name="socio_economic_vertical" required>
                                <option value="">Select Vertical</option>
                                <option value="Education" {{ old('socio_economic_vertical', $proposal->socio_economic_vertical) == 'Education' ? 'selected' : '' }}>Education</option>
                                <option value="Agriculture" {{ old('socio_economic_vertical', $proposal->socio_economic_vertical) == 'Agriculture' ? 'selected' : '' }}>Agriculture</option>
                                <option value="Health" {{ old('socio_economic_vertical', $proposal->socio_economic_vertical) == 'Health' ? 'selected' : '' }}>Health</option>
                                <option value="Power" {{ old('socio_economic_vertical', $proposal->socio_economic_vertical) == 'Power' ? 'selected' : '' }}>Power</option>
                                <option value="Ports" {{ old('socio_economic_vertical', $proposal->socio_economic_vertical) == 'Ports' ? 'selected' : '' }}>Ports</option>
                                <option value="Tourism" {{ old('socio_economic_vertical', $proposal->socio_economic_vertical) == 'Tourism' ? 'selected' : '' }}>Tourism</option>
                                <option value="Mining" {{ old('socio_economic_vertical', $proposal->socio_economic_vertical) == 'Mining' ? 'selected' : '' }}>Mining</option>
                                <option value="Logistics" {{ old('socio_economic_vertical', $proposal->socio_economic_vertical) == 'Logistics' ? 'selected' : '' }}>Logistics</option>
                                <option value="e-Governance" {{ old('socio_economic_vertical', $proposal->socio_economic_vertical) == 'e-Governance' ? 'selected' : '' }}>e-Governance</option>
                                <option value="Security" {{ old('socio_economic_vertical', $proposal->socio_economic_vertical) == 'Security' ? 'selected' : '' }}>Security</option>
                                <option value="Urban Management" {{ old('socio_economic_vertical', $proposal->socio_economic_vertical) == 'Urban Management' ? 'selected' : '' }}>Urban Management</option>
                                <option value="Resource Management" {{ old('socio_economic_vertical', $proposal->socio_economic_vertical) == 'Resource Management' ? 'selected' : '' }}>Resource Management</option>
                            </select>
                            @error('socio_economic_vertical')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="institute_id" class="form-label">Select Institute</label>
                            <select class="form-control @error('institute_id') is-invalid @enderror" 
                                id="institute_id" name="institute_id" required>
                                <option value="">Select Institute</option>
                                @php
                                    $user = Auth::user();
                                    $userInstitute = UserInstitute::where('user_id', $user->id)->first();
                                    $currentVendorZoneId = VendorInstitute::where('institute_id', $userInstitute->institute_id)
                                        ->value('vendor_zone_id');
                                    
                                    // Get institutes from the same vendor zone
                                    $zoneInstitutes = Institute::whereIn('id', function($query) use ($currentVendorZoneId) {
                                        $query->select('institute_id')
                                            ->from('vendor_zone_institutes')
                                            ->where('vendor_zone_id', $currentVendorZoneId);
                                    })->get();
                                @endphp
                                
                                @foreach($zoneInstitutes as $institute)
                                    <option value="{{ $institute->id }}" 
                                        {{ (old('institute_id', $proposal->institute_id) == $institute->id) ? 'selected' : '' }}>
                                        {{ $institute->institute }}
                                    </option>
                                @endforeach
                            </select>
                            @error('institute_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Proposal Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $proposal->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="team_members" class="form-label">Team Members</label>
                            <p class="text-muted small">*Team members from labs of registered institutes</p>
                            <select class="form-control select2 @error('team_members') is-invalid @enderror" 
                                    id="team_members" name="team_members[]" multiple required>
                                <!-- Team members will be loaded via Ajax -->
                            </select>
                            @error('team_members')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="proposal_brief" class="form-label">Proposal Brief</label>
                            <textarea class="form-control @error('proposal_brief') is-invalid @enderror" 
                                id="proposal_brief" name="proposal_brief" rows="3" required>{{ old('proposal_brief', $proposal->proposal_brief) }}</textarea>
                            @error('proposal_brief')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="5" required>{{ old('description', $proposal->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="attachment" class="form-label">Proposal Document</label>
                            @if($proposal->attachment)
                                <div class="mb-2">
                                    <a href="{{ Storage::url($proposal->attachment) }}" class="btn btn-sm btn-info" target="_blank">
                                        <i class="fa fa-download"></i> Current Attachment
                                    </a>
                                </div>
                            @endif
                            <input type="file" class="form-control @error('attachment') is-invalid @enderror" 
                                   id="attachment" name="attachment">
                            <small class="text-muted">Leave empty to keep the current attachment</small>
                            @error('attachment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="expected_completion_date" class="form-label">Project Duration - Expected Completion Date</label>
                                    <input type="date" class="form-control @error('expected_completion_date') is-invalid @enderror" 
                                        id="expected_completion_date" name="expected_completion_date" 
                                        value="{{ old('expected_completion_date', $proposal->expected_completion_date->format('Y-m-d')) }}" required>
                                    @error('expected_completion_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="days_required" class="form-label">Number of Days Required to Access Lab</label>
                                    <input type="number" class="form-control @error('days_required') is-invalid @enderror" 
                                        id="days_required" name="days_required" 
                                        value="{{ old('days_required', $proposal->days_required) }}" required min="1">
                                    @error('days_required')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="expected_output" class="form-label">Expected Output</label>
                            <textarea class="form-control @error('expected_output') is-invalid @enderror" 
                                      id="expected_output" name="expected_output" rows="3" required>{{ old('expected_output', $proposal->expected_output) }}</textarea>
                            @error('expected_output')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize select2
        $('.select2').select2({
            placeholder: 'Select team members',
            allowClear: true
        });

        // Function to load team members based on selected institute
        function loadTeamMembers(instituteId) {
            if (!instituteId) return;
            
            $.ajax({
                url: "{{ route('get.team-members') }}",
                type: "GET",
                data: { institute_id: instituteId },
                success: function(response) {
                    $('#team_members').empty();
                    
                    $.each(response, function(key, member) {
                        $('#team_members').append(
                            '<option value="' + member.id + '">' + 
                            member.name + ' (' + member.email + ')' + 
                            '</option>'
                        );
                    });
                    
                    // If there was previously selected values, reselect them
                    @if(old('team_members'))
                        var oldSelected = {!! json_encode(old('team_members')) !!};
                        $('#team_members').val(oldSelected).trigger('change');
                    @else
                        var proposalTeamMembers = {!! json_encode($proposal->teamMembers->pluck('id')->toArray()) !!};
                        $('#team_members').val(proposalTeamMembers).trigger('change');
                    @endif
                }
            });
        }

        // Load team members when institute changes
        $('#institute_id').on('change', function() {
            loadTeamMembers($(this).val());
        });

        // Load team members on page load if institute is selected
        var selectedInstitute = $('#institute_id').val();
        if (selectedInstitute) {
            loadTeamMembers(selectedInstitute);
        }
    });
</script>
@endpush
@endsection 