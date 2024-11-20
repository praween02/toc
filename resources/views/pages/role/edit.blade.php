@extends('layouts.app')
@section('title', ' - Edit Role')
@section('content')
		<div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">{{ __('app.update_role') }}</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- Form row -->
                    <div class="row">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-body">

                                    <form method="POST" id="save-role-data-form" action="{{ route('roles.update', $role->id) }}">
                                        @csrf
                                        @method('PUT')

                           				<div class="mb-3">
                                            <p><span class="req">*</span> = required fields</p>
                                        </div>

                                        <div class="mb-3">
                                            <label for="name" class="form-label">{{ __('Name') }} <span class="req">*</span></label>
                                            <input type="text" name="name" autocomplete="off" class="form-control" id="name" placeholder="{{ __('placeholder.name') }}" value="{{ $role->name }}" />

                                            @if($errors->has('name'))
                                                <p class="req">{{ $errors->first('name') }}</p>
                                            @endif

                                        </div>

                                        <div class="mb-3">
                                            <label for="slug" class="form-label">{{ __('Slug') }} <span class="req">*</span></label>
                                            <input readonly type="text" name="slug" autocomplete="off" class="form-control" id="slug" placeholder="{{ __('placeholder.slug') }}" value="{{ $role->slug }}" />

                                            @if($errors->has('slug'))
                                                <p class="req">{{ $errors->first('slug') }}</p>
                                            @endif

                                        </div>

                                        <div class="mb-3">
                                            <div class="row">
                                                <p><h4><strong>{{ __('ASSIGN PERMISSIONS') }}</strong> </h4></p>

                                                @if(1 == $role->id)
                                                <div class="col-md-3">
                                                    <p>Admin role can't be edited!</p>
                                                </div>
                                                @else
                                                <div class="col-md-3">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5>Users</h5>
                                                            <ul>
                                                                <li><input type="checkbox" name="users.all" {{ ($role->permission->{'users.list'} && $role->permission->{'users.create'} && $role->permission->{'users.update'} && $role->permission->{'users.delete'}) ? "checked" : "" }} class="all" onclick="check_all(this, 'userchkbox')" /> <strong>All</strong></li>
                                                                <li><input {{ $role->permission->{'users.list'} == 1 ? "checked" : "" }} type="checkbox" name="permission[users.list]" class="userchkbox" value="1" /> <div class="tooltip"> View <span class="tooltiptext">Can view users</span></div></li>
                                                                <li><input {{ $role->permission->{'users.create'} == 1 ? "checked" : "" }} type="checkbox" name="permission[users.create]" class="userchkbox" value="1" /> <div class="tooltip"> Insert <span class="tooltiptext">Can add user</span></div></li>
                                                                <li><input {{ $role->permission->{'users.update'} == 1 ? "checked" : "" }} type="checkbox" name="permission[users.update]" class="userchkbox" value="1" /> <div class="tooltip"> Update <span class="tooltiptext">Can update user</span></div></li>
                                                                <li><input {{ $role->permission->{'users.delete'} == 1 ? "checked" : "" }} type="checkbox" name="permission[users.delete]" class="userchkbox" value="1" /> <div class="tooltip"> Delete <span class="tooltiptext">Can delete user</span></div></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5>Roles</h5>
                                                            <ul>
                                                                <li><input type="checkbox" {{ ($role->permission->{'roles.list'} && $role->permission->{'roles.create'} && $role->permission->{'roles.update'} && $role->permission->{'roles.delete'}) ? "checked" : "" }} name="roles.all" class="all" onclick="check_all(this, 'rolechkbox')"/> <strong>All</strong></li>
                                                                <li><input {{ $role->permission->{'roles.list'} == 1 ? "checked" : "" }} type="checkbox" name="permission[roles.list]" class="rolechkbox" value="1" /> <div class="tooltip"> View <span class="tooltiptext">Can view roles</span></div></li>
                                                                <li><input {{ $role->permission->{'roles.create'} == 1 ? "checked" : "" }} type="checkbox" name="permission[roles.create]" class="rolechkbox" value="1" /> <div class="tooltip"> Insert <span class="tooltiptext">Can add role</span></div></li>
                                                                <li><input {{ $role->permission->{'roles.update'} == 1 ? "checked" : "" }} type="checkbox" name="permission[roles.update]" class="rolechkbox" value="1" /> <div class="tooltip"> Update <span class="tooltiptext">Can update role</span></div></li>
                                                                <li><input {{ $role->permission->{'roles.delete'} == 1 ? "checked" : "" }} type="checkbox" name="permission[roles.delete]" class="rolechkbox" value="1" /> <div class="tooltip"> Delete <span class="tooltiptext">Can delete role</span></div></li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5>Institutes</h5>
                                                            <ul>
                                                                <li><input type="checkbox" {{ ($role->permission->{'institute.list'} && $role->permission->{'institute.create'} && $role->permission->{'institute.update'} && $role->permission->{'institute.delete'}) ? "checked" : "" }} name="institute.all" class="all" onclick="check_all(this, 'instchkbox')"/> <strong>All</strong></li>
                                                                <li><input {{ $role->permission->{'institute.list'} == 1 ? "checked" : "" }} type="checkbox" name="permission[institute.list]" class="instchkbox" value="1" /> <div class="tooltip"> View <span class="tooltiptext">Can view institutes</span></div></li>
                                                                <li><input {{ $role->permission->{'institute.create'} == 1 ? "checked" : "" }} type="checkbox" name="permission[institute.create]" class="instchkbox" value="1" /> <div class="tooltip"> Insert <span class="tooltiptext">Can add institute</span></div></li>
                                                                <li><input {{ $role->permission->{'institute.update'} == 1 ? "checked" : "" }} type="checkbox" name="permission[institute.update]" class="instchkbox" value="1" /> <div class="tooltip"> Update <span class="tooltiptext">Can update institute</span></div></li>
                                                                <li><input {{ $role->permission->{'institute.delete'} == 1 ? "checked" : "" }} type="checkbox" name="permission[institute.delete]" class="instchkbox" value="1" /> <div class="tooltip"> Delete <span class="tooltiptext">Can delete institute</span></div></li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5>Equipment Suppliers</h5>
                                                            <ul>
                                                                <li><input type="checkbox" {{ ($role->permission->{'equ_suppliers.list'} && $role->permission->{'equ_suppliers.create'} && $role->permission->{'equ_suppliers.update'} && $role->permission->{'equ_suppliers.delete'}) ? "checked" : "" }} name="equ_suppliers.all" class="all" onclick="check_all(this, 'eq_sup_chkbox')"/> <strong>All</strong></li>
                                                                <li><input {{ $role->permission->{'equ_suppliers.list'} == 1 ? "checked" : "" }} type="checkbox" name="permission[equ_suppliers.list]" class="eq_sup_chkbox" value="1" /> <div class="tooltip"> View <span class="tooltiptext">Can view equipment suppliers</span></div></li>
                                                                <li><input {{ $role->permission->{'equ_suppliers.create'} == 1 ? "checked" : "" }} type="checkbox" name="permission[equ_suppliers.create]" class="eq_sup_chkbox" value="1" /> <div class="tooltip"> Insert <span class="tooltiptext">Can add equipment supplier</span></div></li>
                                                                <li><input {{ $role->permission->{'equ_suppliers.update'} == 1 ? "checked" : "" }} type="checkbox" name="permission[equ_suppliers.update]" class="eq_sup_chkbox" value="1" /> <div class="tooltip"> Update <span class="tooltiptext">Can update equipment supplier</span></div></li>
                                                                <li><input {{ $role->permission->{'equ_suppliers.delete'} == 1 ? "checked" : "" }} type="checkbox" name="permission[equ_suppliers.delete]" class="eq_sup_chkbox" value="1" /> <div class="tooltip"> Delete <span class="tooltiptext">Can delete equipment supplier</span></div></li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5>Institute Users </h5>
                                                            <ul>
                                                                <li><input type="checkbox" {{ ($role->permission->{'inst_user.list'} && $role->permission->{'inst_user.create'} && $role->permission->{'inst_user.update'} && $role->permission->{'inst_user.delete'}) ? "checked" : "" }} name="inst_user.all" class="all" onclick="check_all(this, 'inst_user_chkbox')"/> <strong>All</strong></li>
                                                                <li><input {{ $role->permission->{'inst_user.list'} == 1 ? "checked" : "" }} type="checkbox" name="permission[inst_user.list]" class="inst_user_chkbox" value="1" /> <div class="tooltip"> View <span class="tooltiptext">Can view institute users</span></div></li>
                                                                <li><input {{ $role->permission->{'inst_user.create'} == 1 ? "checked" : "" }} type="checkbox" name="permission[inst_user.create]" class="inst_user_chkbox" value="1" /> <div class="tooltip"> Insert <span class="tooltiptext">Can add institute user</span></div></li>
                                                                <li><input {{ $role->permission->{'inst_user.update'} == 1 ? "checked" : "" }} type="checkbox" name="permission[inst_user.update]" class="inst_user_chkbox" value="1" /> <div class="tooltip"> Update <span class="tooltiptext">Can update institute user</span></div></li>
                                                                <li><input {{ $role->permission->{'inst_user.delete'} == 1 ? "checked" : "" }} type="checkbox" name="permission[inst_user.delete]" class="inst_user_chkbox" value="1" /> <div class="tooltip"> Delete <span class="tooltiptext">Can delete institute user</span></div></li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-3">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5>Equipments </h5>
                                                            <ul>
                                                                <li><input type="checkbox" {{ ($role->permission->{'equipment.list'} && $role->permission->{'equipment.create'} && $role->permission->{'equipment.update'} && $role->permission->{'equipment.delete'}) ? "checked" : "" }} name="equipment.all" class="all" onclick="check_all(this, 'equipment_chkbox')"/> <strong>All</strong></li>
                                                                <li><input {{ $role->permission->{'equipment.list'} == 1 ? "checked" : "" }} type="checkbox" name="permission[equipment.list]" class="equipment_chkbox" value="1" /> <div class="tooltip"> View <span class="tooltiptext">Can view equipments</span></div></li>
                                                                <li><input {{ $role->permission->{'equipment.create'} == 1 ? "checked" : "" }} type="checkbox" name="permission[equipment.create]" class="equipment_chkbox" value="1" /> <div class="tooltip"> Insert <span class="tooltiptext">Can add equipment</span></div></li>
                                                                <li><input {{ $role->permission->{'equipment.update'} == 1 ? "checked" : "" }} type="checkbox" name="permission[equipment.update]" class="equipment_chkbox" value="1" /> <div class="tooltip"> Update <span class="tooltiptext">Can update equipment</span></div></li>
                                                                <li><input {{ $role->permission->{'equipment.delete'} == 1 ? "checked" : "" }} type="checkbox" name="permission[equipment.delete]" class="equipment_chkbox" value="1" /> <div class="tooltip"> Delete <span class="tooltiptext">Can delete equipment</span></div></li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                @endif
                                        </div>

                                        <button type="submit" class="btn btn-primary waves-effect waves-light"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send feather-sm fill-white me-2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>Submit</button>

                                    </form>

                                </div> <!-- end card-body -->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- container -->
            </div> <!-- content -->
        </div>
@endsection
@push('scripts')
<script>
        function check_all(ths, cls) {
            $(`.${cls}`).prop('checked', ths.checked);
        }
</script>
@endpush
