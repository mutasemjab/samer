<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Start Content-->
    <div class="container-fluid">


        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo e(env('APP_NAME')); ?></a></li>

                        </ol>
                    </div>
                    <h4 class="page-title">Employee</h4>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-md-12">

                            </div>
                            <div class="col-sm-4">

                                <?php echo e($data->links()); ?>


                            </div>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('employee-add')): ?>
                                <div class="col-sm-8">
                                    <div class="text-sm-right">
                                        <a type="button" href="<?php echo e(route("admin.employee.create")); ?>"
                                            class="btn btn-primary waves-effect waves-light mb-2 text-white">New Employee
                                        </a>
                                    </div>
                                </div><!-- end col-->
                            <?php endif; ?>
                        </div>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('employee-table')): ?>
                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap table-hover mb-0">
                                    <thead class="thead-light">

                                        <tr>

                                            <th>Name</th>
                                            <th>User name</th>
                                            <th style="width: 82px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>

                                                <td><span class="font-weight-bold"><?php echo e($value->name); ?></span></td>
                                                <td><span class="font-weight-bold"><?php echo e($value->username); ?></span></td>
                                                <td>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('employee-edit')): ?>
                                                        <a class="btn btn-sm btn-outline-info"
                                                            href="<?php echo e(route("admin.employee.edit", $value->id)); ?>"><i
                                                                class="mdi mdi-pencil-box"></i>Edit</a>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('employee-delete')): ?>
                                                        <a class="btn btn-sm btn-outline-danger"
                                                            href="<?php echo e(route("admin.employee.destroy", $value->id)); ?>"><i
                                                                class="mdi mdi-trash-can"></i>Delete</a>
                                                    <?php endif; ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div>
        </div>
    </div> <!-- container -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.3/dist/sweetalert2.min.js"></script>
    <script src="<?php echo e(asset('assets/js/category.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u167651649/domains/mutasemjaber.online/public_html/ayla/resources/views/admin/employee/index.blade.php ENDPATH**/ ?>