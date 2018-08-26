<?php $__env->startSection('content'); ?>
    <div class="heading">
        <?php echo app('translator')->getFromJson('Reset Password'); ?>
    </div>
    <form method="POST" action="<?php echo e(route('password.email')); ?>">
        <?php echo csrf_field(); ?>

        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>"
                   name="email" value="<?php echo e(old('email')); ?>" required autofocus>
        </div>

        <div class="btnHolder">
            <button type="submit" class="btnGrad">
                <?php echo app('translator')->getFromJson('Send Password Reset Link'); ?>
            </button>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest-auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>