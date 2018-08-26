<?php
    $formTitle = 'Create Tester Profile';
    $formTitleSmall = 'Date of Birth is CRUCIAL for you or your son, daughter, student, ...';

    $formAction = route('tester.store');
    $formMethod = 'POST';
?>

<?php $__env->startSection('breadcrumbs'); ?>
    <?php echo breadcrumbs([
        ['label' => 'Testers', 'url' => route('tester.index')],
        'New hempBLOCK Tester'
    ]); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="pageHolder">
        <div class="minContainer">
            <div class="pagePanelHolder">
                <div class="pagePanelBody">
                    <!--      Wizard container        -->
                    <?php echo $__env->make('tester._form.index', ['tester'=>[]], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <!-- wizard container -->
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>