<?php $__env->startSection('title'); ?>
<?php echo e(__('messages.dealers')); ?>

<?php $__env->stopSection(); ?>





<?php $__env->startSection('content'); ?>



<div class="card">
    <div class="card-header">
        <h3 class="card-title card_title_center"> <?php echo e(__('messages.dealers')); ?> </h3>
        
        
        <a href="<?php echo e(route('admin.dealers.create')); ?>" class="btn btn-sm btn-success"> <?php echo e(__('messages.New')); ?> <?php echo e(__('messages.dealers')); ?></a>

    </div>
    <!-- /.card-header -->
    <div class="card-body">


        


        <div class="clearfix"></div>

        <div id="ajax_responce_serarchDiv" class="col-md-12">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('dealer-table')): ?>
            <?php if(@isset($data) && !@empty($data) && count($data) > 0): ?>
            <table id="example2" class="table table-bordered table-hover">
                <thead class="custom_thead">

                    <th><?php echo e(__('messages.Name')); ?> </th>
                    <th> <?php echo e(__('messages.Email')); ?> </th>
                    <th><?php echo e(__('messages.Phone')); ?> </th>
                    <th><?php echo e(__('messages.Activate')); ?> </th>
                    <th></th>

                </thead>
                <tbody>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>

                        <td><?php echo e($info->name); ?></td>
                        <td><?php echo e($info->email); ?></td>
                        <td><?php echo e($info->phone); ?></td>
                        <td>
                            <?php echo e($info->activate == 1 ? "Yes" : "No"); ?>

                        </td>


                        <td>
                            
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('dealer-edit')): ?>
                            <a href="<?php echo e(route('admin.dealers.edit', $info->id)); ?>" class="btn btn-sm  btn-primary"> <?php echo e(__('messages.Edit')); ?></a>
                            <?php endif; ?>
                            <a href="<?php echo e(route('admin.dealers.export', ['search' => $searchQuery])); ?>"
                                class="btn btn-sm btn-success">Export to Excel</a>
                        </td>


                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>
            </table>
            <br>
            <?php echo e($data->appends(['search' => $searchQuery])->links()); ?>

            <?php else: ?>
            <div class="alert alert-danger">
                <?php echo e(__('messages.No_data')); ?> </div>
            <?php endif; ?>

        </div>
        <?php endif; ?>

    </div>

</div>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('assets/admin/js/dealers.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u167651649/domains/mutasemjaber.online/public_html/ayla/resources/views/admin/dealers/index.blade.php ENDPATH**/ ?>