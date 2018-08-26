<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('auth._partials.tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <form method="POST" action="">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>"
                   name="email" value="<?php echo e(old('email')); ?>" required autofocus>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>"
                   name="password" required>
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> Remember Me
            </label>
        </div>

        <div class="btnHolder">
            <button type="submit" class="btnGrad">
                Login
            </button>

            <a href="<?php echo e(route('password.request')); ?>">
                <?php echo app('translator')->getFromJson('Forgot Your Password?'); ?>
            </a>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest-auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>