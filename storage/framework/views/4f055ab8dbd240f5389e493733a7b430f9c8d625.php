<?php
    $formTitle = 'Create Laboratory Profile';
    $formTitleSmall = 'Just fill the form';
    $formAction = route('lab.store');
    $formMethod = 'POST';
?>

<?php $__env->startSection('breadcrumbs'); ?>
    <?php echo breadcrumbs([
        ['label' => 'Laboratories', 'url' => route('lab.index')],
        'New Lab'
    ]); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="pageHolder">
        <div class="minContainer">
            <div class="pagePanelHolder">
                <div class="pagePanelBody">
                    <!-- Wizard container -->
                    <?php echo $__env->make('lab._form.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <!-- wizard container -->
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>