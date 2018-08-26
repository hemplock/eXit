
<div class="inputRow <?php echo e((isset($asSample) and $asSample) ? 'hidden' : ''); ?>" data-section="prop-sample">
    <?php echo $__env->make('component.wizard.input',[
        'iIcon'                 => '<i class="fa fa-circle-o fa-2x fa-fw"></i>',
        'iPlaceholder'          => 'Option',
        'iPlaceholderSmall'     => '(required)',
        'iName'                 => $mName."[key][]",
        'iValue'                => (isset($prop) and !empty($prop['name'])) ? $prop['name'] : '',
    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('component.wizard.input',[
        'iIcon'                 => '<i class="fa fa-chevron-circle-right fa-2x fa-fw"></i>',
        'iPlaceholder'          => 'Value',
        'iPlaceholderSmall'     => '(required)',
        'iName'                 => $mName."[value][]",
        'iValue'                =>  (isset($prop) and !empty($prop['value'])) ? $prop['value'] : '',
    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="removeBtnHolder">
        <a href="#" class="removeRecord">
            <i class="fa fa-times"></i>
        </a>
    </div>
</div>