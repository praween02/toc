<?php $__env->startSection('title', ' - Edit Ticket'); ?>
<?php $__env->startSection('content'); ?>
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
                                <h4 class="page-title">Ticket No - <?php echo e($ticket->ticket_no); ?></h4>
                                <h4 class="page-title">Status -  <?php echo ($ticket->status == 'open' ? ("<span class='badge btn-info'>Open</span>") : (($ticket->status == 'in-progress') ? "<span class='badge btn-secondary'>In Progress</span>" : "<span class='badge btn-success'>Closed</span>")); ?></h4>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- Form row -->

                    <?php if($ticket->status != "closed"): ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <form method="POST" id="update-ticket-data-form" action="<?php echo e(route('tickets.update', $ticket->ticket_no)); ?>">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>

                                        <div class="mb-3">
                                            <p><span class="req">*</span> = required fields</p>
                                        </div>

                                        <?php
                                            $onchange = '';
                                            if(in_array('vendor', get_roles()))
                                            $onchange = "onchange=sel_subject(this.value)";
                                        ?>


                                        <!-- <div class="mb-3">
                                            <label for="subject" class="form-label"><?php echo e(__('Subject')); ?> <span class="req">*</span></label>
                                            <select name="subject" autocomplete="off" class="form-control" id="subject" placeholder="<?php echo e(__('placeholder.subject')); ?>" <?php echo e($onchange); ?>>
                                                 <option value="">-- Select --</option>
                                                 <option value="equipment_related" <?php echo e($ticket->subject == "equipment_related" ? "selected" : ""); ?>>Equipment related</option>
                                                 <option value="others" <?php echo e($ticket->subject == "others" ? "selected" : ""); ?>>Others</option>
                                            </select>

                                            <?php if($errors->has('subject')): ?>
                                                <p class="req"><?php echo e($errors->first('subject')); ?></p>
                                            <?php endif; ?>

                                        </div>
 -->
                                        <?php if(in_array('vendor', get_roles())): ?>

                                        <!-- <div class="mb-3 <?php echo e($ticket->subject == 'equipment_related' ? '' : 'd-none'); ?>" id="equipment_box">
                                            <label for="institute" class="form-label"><?php echo e(__('Institute')); ?> <span class="req">*</span></label>
                                            <select name="institute" autocomplete="off" class="form-control" id="institute" placeholder="<?php echo e(__('placeholder.institute')); ?>">
                                                <?php $__currentLoopData = $institutes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $institute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php echo e(($ticket->institute == $institute->id ? 'selected' : '')); ?> value="<?php echo e($institute->id); ?>"><?php echo e($institute->institute); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>

                                            <?php if($errors->has('institute')): ?>
                                                <p class="req"><?php echo e($errors->first('institute')); ?></p>
                                            <?php endif; ?>

                                        </div> -->
                                        
                                        <?php endif; ?>


                                        <div class="mb-3">
                                            <label for="description" class="form-label"><?php echo e(__('Description')); ?> <span class="req">*</span></label>
                                            <textarea style="height:200px" name="description" autocomplete="off" class="form-control" id="description" placeholder="<?php echo e(__('placeholder.description')); ?>"><?php echo $ticket->description; ?></textarea>

                                            <?php if($errors->has('description')): ?>
                                                <p class="req"><?php echo e($errors->first('description')); ?></p>
                                            <?php endif; ?>

                                        </div>

                                        <?php if(current_user_id() == $ticket->user_id): ?>
                                        <div class="mb-3">
                                            <label for="status" class="form-label"><?php echo e(__('Status')); ?> <span class="req">*</span></label>
                                            <select name="status" class="form-control">
                                                <option value="open" <?php echo e($ticket->status == "open" ? "selected" : ""); ?>>Open</option>
                                                <option value="in-progress" <?php echo e($ticket->status == "in-progress" ? "selected" : ""); ?>>In-Progress</option>
                                                <option value="closed" <?php echo e($ticket->status == "closed" ? "selected" : ""); ?>>Closed</option>
                                            </select>

                                            <?php if($errors->has('status')): ?>
                                                <p class="req"><?php echo e($errors->first('status')); ?></p>
                                            <?php endif; ?>

                                        </div>
                                        <?php endif; ?>

                                        <button type="submit" class="btn btn-primary waves-effect waves-light"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send feather-sm fill-white me-2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>Submit</button>

                                    </form>


                                </div> <!-- end card-body -->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                    <?php endif; ?>


                    <div class="row">
                        <div class="col-12">

                            <?php $__empty_1 = true; $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="be-comment-content commentsection">
                               <span class="be-comment-name"> <?php echo e(ucwords($comment->name)); ?> </span> 
                               <span class="be-comment-time txt-right"> <i class="fa fa-clock-o"></i> <?php echo e(date('D, j M\'y h:i A', strtotime($comment->created_at))); ?> </span>
                               <div class="be-comment-text"> <?php echo $comment->message; ?></div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <?php endif; ?>


                        </div>

                    </div>


                    

                </div> <!-- container -->
            </div> <!-- content -->
        </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('assets/js/ckeditor.js?v=40.2.0')); ?>"></script>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u457512262/domains/dssolution.in/public_html/dot/resources/views/pages/ticket/edit.blade.php ENDPATH**/ ?>