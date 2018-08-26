<?php
$wizard_validation_rules = '{
    "lab_props[key][]": {
        required: true,
        minlength: 1,
        maxlength: 150

    },
    "lab_props[value][]": {
        required: true,
        minlength: 1,
        maxlength: 150
    },
    "lab[name]": {
        required: true,
        minlength: 3,
        maxlength: 150
    },
    "lab[address]": {
        required: true,
        minlength: 3,
        maxlength: 500
    }
}';
?>
<script>
    var validation_rules = <?php echo $wizard_validation_rules; ?>;
</script>
<?php $__env->startPush('scripts'); ?>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset ('js/wizard.js')); ?>"></script>
<?php $__env->stopPush(); ?>
