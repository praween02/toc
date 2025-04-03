<?php $__env->startSection('title', ' - Add Role'); ?>
<?php $__env->startSection('content'); ?>
		<div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"><?php echo e(__('app.add_role')); ?></h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- Form row -->
                    <div class="row">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-body">

                                    <form method="POST" id="save-vendor-data-form" action="<?php echo e(route('roles.store')); ?>">
                                        <?php echo csrf_field(); ?>

                           				<div class="mb-3">
                                            <p><span class="req">*</span> = required fields</p>
                                        </div>

                                        <div class="mb-3">
                                            <label for="name" class="form-label"><?php echo e(__('Name')); ?> <span class="req">*</span></label>
                                            <input type="text" name="name" autocomplete="off" class="form-control" id="name" placeholder="<?php echo e(__('placeholder.role_name')); ?>" value="<?php echo e(old('name')); ?>" />

                                            <?php if($errors->has('name')): ?>
                                                <p class="req"><?php echo e($errors->first('name')); ?></p>
                                            <?php endif; ?>

                                        </div>
                                        

                                        <div class="mb-3">
                                            <div class="row">
                                                <p><h4><strong><?php echo e(__('ASSIGN PERMISSIONS')); ?></strong> </h4></p>
                                                <div class="col-md-3">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5>Users</h5>
                                                            <ul>
                                                                <li><input type="checkbox" name="users.all" class="all" onclick="check_all(this, 'userchkbox')" /> <strong>All</strong></li>
                                                                <li><input type="checkbox" name="permission[users.list]" class="userchkbox" value="1" /> 
                                                                        <div class="tooltip"> View <span class="tooltiptext">Can view users</span></div>
                                                                </li>
                                                                <li><input type="checkbox" name="permission[users.create]" class="userchkbox" value="1" />
                                                                    <div class="tooltip"> Insert <span class="tooltiptext">Can add user</span></div>
                                                                </li>
                                                                <li><input type="checkbox" name="permission[users.update]" class="userchkbox" value="1" />     
                                                                    <div class="tooltip"> Update <span class="tooltiptext">Can update user</span></div>
                                                                </li>
                                                                <li><input type="checkbox" name="permission[users.delete]" class="userchkbox" value="1" />
                                                                    <div class="tooltip"> Delete <span class="tooltiptext">Can delete user</span></div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-3">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5>Roles</h5>
                                                            <ul>
                                                                <li><input type="checkbox" name="roles.all" class="all" onclick="check_all(this, 'rolechkbox')"/> <strong>All</strong></li>
                                                                <li><input type="checkbox" name="permission[roles.list]" class="rolechkbox" value="1" /> 
                                                                    <div class="tooltip"> View <span class="tooltiptext">Can view roles</span></div>
                                                                </li>
                                                                <li><input type="checkbox" name="permission[roles.create]" class="rolechkbox" value="1" />
                                                                    <div class="tooltip"> Insert <span class="tooltiptext">Can add role</span></div>
                                                                </li>
                                                                <li><input type="checkbox" name="permission[roles.update]" class="rolechkbox" value="1" />
                                                                    <div class="tooltip"> Update <span class="tooltiptext">Can update role</span></div>
                                                                </li>
                                                                <li><input type="checkbox" name="permission[roles.delete]" class="rolechkbox" value="1" />
                                                                    <div class="tooltip"> Delete <span class="tooltiptext">Can delete role</span></div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5>Institutes</h5>
                                                            <ul>
                                                                <li><input type="checkbox" name="institute.all" class="all" onclick="check_all(this, 'instchkbox')"/> <strong>All</strong></li>
                                                                <li><input type="checkbox" name="permission[institute.list]" class="instchkbox" value="1" /> 
                                                                    <div class="tooltip"> View <span class="tooltiptext">Can view institute</span></div>
                                                                </li>
                                                                <li><input type="checkbox" name="permission[institute.create]" class="instchkbox" value="1" />
                                                                    <div class="tooltip"> Insert <span class="tooltiptext">Can add institute</span></div>
                                                                </li>
                                                                <li><input type="checkbox" name="permission[institute.update]" class="instchkbox" value="1" />
                                                                    <div class="tooltip"> Update <span class="tooltiptext">Can update institute</span></div>
                                                                </li>
                                                                <li><input type="checkbox" name="permission[institute.delete]" class="instchkbox" value="1" />
                                                                    <div class="tooltip"> Delete <span class="tooltiptext">Can delete institute</span></div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-3">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5>Equipment Suppliers</h5>
                                                            <ul>
                                                                <li><input type="checkbox" name="equ_suppliers.all" class="all" onclick="check_all(this, 'equ_sup_chkbox')"/> <strong>All</strong></li>
                                                                <li><input type="checkbox" name="permission[equ_suppliers.list]" class="equ_sup_chkbox" value="1" /> 
                                                                    <div class="tooltip"> View <span class="tooltiptext">Can view equipment suppliers</span></div>
                                                                </li>
                                                                <li><input type="checkbox" name="permission[equ_suppliers.create]" class="equ_sup_chkbox" value="1" />
                                                                    <div class="tooltip"> Insert <span class="tooltiptext">Can add equipment supplier</span></div>
                                                                </li>
                                                                <li><input type="checkbox" name="permission[equ_suppliers.update]" class="equ_sup_chkbox" value="1" />
                                                                    <div class="tooltip"> Update <span class="tooltiptext">Can update equipment supplier</span></div>
                                                                </li>
                                                                <li><input type="checkbox" name="permission[equ_suppliers.delete]" class="equ_sup_chkbox" value="1" />
                                                                    <div class="tooltip"> Delete <span class="tooltiptext">Can delete equipment supplier</span></div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5>Institute Users</h5>
                                                            <ul>
                                                                <li><input type="checkbox" name="inst_user.all" class="all" onclick="check_all(this, 'ins_user_chkbox')"/> <strong>All</strong></li>
                                                                <li><input type="checkbox" name="permission[inst_user.list]" class="ins_user_chkbox" value="1" /> 
                                                                    <div class="tooltip"> View <span class="tooltiptext">Can view institute users</span></div>
                                                                </li>
                                                                <li><input type="checkbox" name="permission[inst_user.create]" class="ins_user_chkbox" value="1" />
                                                                    <div class="tooltip"> Insert <span class="tooltiptext">Can add institute user</span></div>
                                                                </li>
                                                                <li><input type="checkbox" name="permission[inst_user.update]" class="ins_user_chkbox" value="1" />
                                                                    <div class="tooltip"> Update <span class="tooltiptext">Can update institute user</span></div>
                                                                </li>
                                                                <li><input type="checkbox" name="permission[inst_user.delete]" class="ins_user_chkbox" value="1" />
                                                                    <div class="tooltip"> Delete <span class="tooltiptext">Can delete institute user</span></div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5>Equipments</h5>
                                                            <ul>
                                                                <li><input type="checkbox" name="equipment.all" class="all" onclick="check_all(this, 'equchkbox')" /> <strong>All</strong></li>
                                                                <li><input type="checkbox" name="permission[equipment.list]" class="equchkbox" value="1" /> 
                                                                        <div class="tooltip"> View <span class="tooltiptext">Can view equipment</span></div>
                                                                </li>
                                                                <li><input type="checkbox" name="permission[equipment.create]" class="equchkbox" value="1" />
                                                                    <div class="tooltip"> Insert <span class="tooltiptext">Can add equipment</span></div>
                                                                </li>
                                                                <li><input type="checkbox" name="permission[equipment.update]" class="equchkbox" value="1" />     
                                                                    <div class="tooltip"> Update <span class="tooltiptext">Can update equipment</span></div>
                                                                </li>
                                                                <li><input type="checkbox" name="permission[equipment.delete]" class="equchkbox" value="1" />
                                                                    <div class="tooltip"> Delete <span class="tooltiptext">Can delete equipment</span></div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>


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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
        function check_all(ths, cls) {
            $(`.${cls}`).prop('checked', ths.checked);
        }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u457512262/domains/dssolution.in/public_html/dot/resources/views/pages/role/create.blade.php ENDPATH**/ ?>