<?php $__env->startSection('title'); ?>
<?php echo e(__('messages.Edit')); ?> <?php echo e(__('messages.sectionUsers')); ?>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('contentheaderlink'); ?>
<a href="<?php echo e(route('sectionUsers.index')); ?>"> <?php echo e(__('messages.sectionUsers')); ?> </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheaderactive'); ?>
<?php echo e(__('messages.Edit')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title text-center"><?php echo e(__('messages.Edit')); ?> <?php echo e(__('messages.sectionUsers')); ?></h3>
    </div>
    <div class="card-body">
        <form action="<?php echo e(route('sectionUsers.update', $data['id'])); ?>" method="post" enctype='multipart/form-data'>
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name_en"><?php echo e(__('messages.Name_en')); ?></label>
                        <input type="text" name="name_en" id="name_en" class="form-control"
                            value="<?php echo e(old('name_en', $data['name_en'])); ?>">
                        <?php $__errorArgs = ['name_en'];
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
                        <label for="name_ar"><?php echo e(__('messages.Name_ar')); ?></label>
                        <input type="text" name="name_ar" id="name_ar" class="form-control"
                            value="<?php echo e(old('name_ar', $data['name_ar'])); ?>">
                        <?php $__errorArgs = ['name_ar'];
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

                


        
                <div class="col-md-12 text-center">
                    <div class="form-group">
                        <button id="do_add_item_cardd" type="submit" class="btn btn-primary btn-sm"><?php echo e(__('messages.Update')); ?></button>
                        <a href="<?php echo e(route('sectionUsers.index')); ?>" class="btn btn-danger btn-sm"><?php echo e(__('messages.Cancel')); ?></a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ayla\resources\views/admin/sectionUsers/edit.blade.php ENDPATH**/ ?>