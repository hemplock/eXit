<div class="heading">
    <a href="<?php echo e(route('login')); ?>" <?php echo e(Route::is('login') ? 'class=active' : ''); ?> >Sign In</a>
    <div class="divider">or</div>
    <a href="<?php echo e(route('register')); ?>" <?php echo e(Route::is('register') ? 'class=active' : ''); ?> >Sign Up</a>
</div>