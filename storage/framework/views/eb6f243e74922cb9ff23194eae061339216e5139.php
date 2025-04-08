<?php $__env->startSection('title'); ?>
notifications
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

      <div class="card">
        <div class="card-header">
          <h3 class="card-title card_title_center"> Add New notifications   </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">


            <div class="row justify-content-center">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <form action="<?php echo e(route('notifications.send')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="form-group mt-0">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control <?php if($errors->has('title')): ?> is-invalid <?php endif; ?>" id="title"  name="title" value="<?php echo e(old('title')); ?>">
                                    <?php if($errors->has('title')): ?>
                                        <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('title')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label for="body">Body</label>
                                    <textarea name="body" id="body" class="form-control <?php if($errors->has('body')): ?> is-invalid <?php endif; ?>"
                                              ><?php echo e(old('body')); ?></textarea>
                                    <?php if($errors->has('body')): ?>
                                        <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('body')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <div class="text-right mt-3">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Send Notifications</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>


            </div>




        </div>
      </div>






<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>

<script>
    function previewImage() {
      var preview = document.getElementById('image-preview');
      var input = document.getElementById('Item_img');
      var file = input.files[0];
      if (file) {
      preview.style.display = "block";
      var reader = new FileReader();
      reader.onload = function() {
        preview.src = reader.result;
      }
      reader.readAsDataURL(file);
    }else{
        preview.style.display = "none";
    }
}
  </script>


<?php $__env->stopSection(); ?>







<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u167651649/domains/mutasemjaber.online/public_html/ayla/resources/views/admin/notifications/create.blade.php ENDPATH**/ ?>