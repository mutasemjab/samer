<?php $__env->startSection('title'); ?>
    <?php echo e(__('messages.Edit')); ?> <?php echo e(__('messages.transfers')); ?>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('contentheaderlink'); ?>
    <a href="<?php echo e(route('transfers.index')); ?>"> <?php echo e(__('messages.transfers')); ?> </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheaderactive'); ?>
    <?php echo e(__('messages.Edit')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title card_title_center"> <?php echo e(__('messages.Edit')); ?> <?php echo e(__('messages.transfers')); ?> </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="<?php echo e(route('transfers.update', $data['id'])); ?>" method="post" enctype='multipart/form-data'>
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="user_select"><?php echo e(__('messages.User')); ?></label>
                        <select class="form-control" name="user" id="user_select">
                            <option value="">Select users</option>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($user->id); ?>" <?php echo e($user->id == $data->user_id ? 'selected' : ''); ?>>
                                    <?php echo e($user->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['user'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="dealer_select"><?php echo e(__('messages.dealers')); ?></label>
                        <select class="form-control" name="dealer" id="dealer_select">
                            <option value="">Select dealers</option>
                            <?php $__currentLoopData = $dealers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dealer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($dealer->id); ?>" <?php echo e($dealer->id == $data->user_id ? 'selected' : ''); ?>>
                                    <?php echo e($dealer->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['dealer'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__('messages.Deposit')); ?></label>
                            <input name="deposit" id="deposit" class="form-control"
                                value="<?php echo e(old('deposit', $data['deposit'])); ?>" />
                            <?php $__errorArgs = ['deposit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__('messages.Withdrawal')); ?></label>
                            <input name="withdrawal" id="withdrawal" class="form-control"
                                value="<?php echo e(old('withdrawal', $data['withdrawal'])); ?>" />
                            <?php $__errorArgs = ['withdrawal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__('messages.Note')); ?></label>
                            <textarea name="note" id="note" class="form-control" rows="8"><?php echo e(old('note', $data['note'])); ?></textarea>
                            <?php $__errorArgs = ['note'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button id="do_add_item_cardd" type="submit" class="btn btn-primary btn-sm"><?php echo e(__('messages.Update')); ?></button>
                            <a href="<?php echo e(route('transfers.index')); ?>" class="btn btn-sm btn-danger"><?php echo e(__('messages.Cancel')); ?></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const userSelect = document.getElementById('user_select');
            const dealerSelect = document.getElementById('dealer_select');

            function toggleSelects() {
                if (userSelect.value) {
                    dealerSelect.disabled = true;
                } else {
                    dealerSelect.disabled = false;
                }

                if (dealerSelect.value) {
                    userSelect.disabled = true;
                } else {
                    userSelect.disabled = false;
                }
            }

            userSelect.addEventListener('change', toggleSelects);
            dealerSelect.addEventListener('change', toggleSelects);

            // Initial toggle state
            toggleSelects();
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u167651649/domains/mutasemjaber.online/public_html/ayla/resources/views/admin/transfers/edit.blade.php ENDPATH**/ ?>