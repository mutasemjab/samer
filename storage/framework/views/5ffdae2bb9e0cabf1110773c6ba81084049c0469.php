<?php $__env->startSection('title'); ?>
    <?php echo e(__('messages.Edit')); ?> <?php echo e(__('messages.services')); ?>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('contentheaderlink'); ?>
    <a href="<?php echo e(route('services.index')); ?>"> <?php echo e(__('messages.services')); ?> </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheaderactive'); ?>
    <?php echo e(__('messages.Edit')); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title card_title_center"> <?php echo e(__('messages.Edit')); ?> <?php echo e(__('messages.services')); ?> </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">




                <form action="<?php echo e(route('services.update', $service['id'])); ?>" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__('messages.Name')); ?></label>
                            <input name="name" id="name" class="form-control"
                                value="<?php echo e(old('name', $service['name'])); ?>">
                            <?php $__errorArgs = ['name'];
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
                            <label> <?php echo e(__('messages.price')); ?></label>
                            <input name="price" id="price" class="form-control"
                                value="<?php echo e(old('price', $service['price'])); ?>" />
                            <?php $__errorArgs = ['price'];
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
                            <button id="do_add_item_cardd" type="submit" class="btn btn-primary btn-sm"> <?php echo e(__('messages.Update')); ?></button>
                            <a href="<?php echo e(route('services.index')); ?>" class="btn btn-sm btn-danger"><?php echo e(__('messages.Cancel')); ?></a>

                        </div>
                    </div>


            </div>

            </form>

        </div>




    </div>
    </div>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\samer\resources\views/admin/services/edit.blade.php ENDPATH**/ ?>