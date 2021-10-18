<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="mx-auto">
            <form action="<?php echo e(route('startGame')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><?php echo e(__('custom.nickname')); ?></span>
                    </div>
                    
                    <input type="text" class="form-control" name="nickname" value="<?php echo e(session('nickname')); ?>" required>

                    <div class="invalid-tooltip <?php echo e($errors->has('nickname') ? 'd-block' : ''); ?>">
                        <?php echo e($errors->first('nickname')); ?>

                    </div>
                </div>

                <div class="mt-5">
                    <button type="submit" class="btn btn-info"><?php echo e(__('custom.start')); ?></button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', ['title' => __('custom.welcome')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /mnt/c/Projects/game/resources/views/welcome.blade.php ENDPATH**/ ?>