<?php $__env->startSection('breadcrumbs'); ?>
    <?php echo breadcrumbs(trans('Harvest')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="pageHolder">
        <div class="pagePanelHolder">
            <div class="pagePanelHeading">
                <div class="captionHolder">
                    <div class="icoHolder">
                        <i class="material-icons">assignment</i>
                    </div>
                    <div class="caption">Harvest</div>
                </div>
            </div>
            <div class="pagePanelBody">
                <div class="tableHolder">
                    <?php if( count($harvests)>0): ?>
                        <table class="table">
                            <thead class="text-warning">
                            <tr>
                                <th>Strain Harvested</th>
                                <th>Declared at</th>
                                <th class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $harvests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $crop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($crop->strain_harvested); ?></td>
                                    <td><?php echo e($crop->created_at); ?></td>
                                    <td class="td-actions text-right">
                                        <a href="<?php echo e(route('harvest.show', [$crop->farmer, $crop])); ?>" rel="tooltip" class="actionBtn">
                                            <i class="material-icons">remove_red_eye</i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>