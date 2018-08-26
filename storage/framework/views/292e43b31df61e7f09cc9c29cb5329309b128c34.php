<?php
    $wizard_validation_rules = '{
        "tester_props[key][]": {
            required: true,
            minlength: 1,
            maxlength: 150
        },
        "tester_props[value][]": {
            required: true,
            minlength: 1,
            maxlength: 150
        },
        "tester[lastname]": {
            required: true,
            minlength: 1,
            maxlength: 150
        },
        "tester[firstname]": {
            required: true,
            minlength: 1,
            maxlength: 150
        },
        "tester[email]": {
            remote: {
                url: "'. route('tester.validate', (Request::route('tester')) ? ['tester_id' => Request::route('tester')] : []) /** @see https://stackoverflow.com/questions/16577120/jquery-validate-remote-method-usage-to-check-if-username-already-exists */ .'",
                type: "get"
            },
            required: true,
            minlength: 1,
            maxlength: 150
        },
        "tester[address]": {
            required: true,
            minlength: 1,
            maxlength: 180
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
