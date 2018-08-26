<?php $__env->startSection('content'); ?>
    <div class="pageHolder">
        <div class="pagePanelHolder">
            <div class="pagePanelHeading">
                <div class="captionHolder">
                    <div class="icoHolder">
                        <i class="material-icons">colorize</i>
                    </div>
                    <div class="caption">Expertises</div>
                </div>
            </div>

            <div class="pagePanelBody">
                <div class="tableHolder">
                    <?php if( count($expertises)>0): ?>
                        <table class="table">
                            <thead class="text-warning">
                            <tr>
                                <th>Harvest</th>
                                <th>Farmer</th>
                                <th>Labaratory</th>
                                <th class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $expertises; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expertise): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo e(route('harvest.show',[ 'farmer'=>$expertise->harvest->farmer, $expertise->harvest ])); ?>">
                                            <?php echo e($expertise->harvest->strain_harvested); ?>

                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('farmer.show', $expertise->harvest->farmer)); ?>">
                                            <?php echo e($expertise->harvest->farmer->firstname); ?>

                                            <?php echo e($expertise->harvest->farmer->lastname); ?>

                                        </a>
                                    </td>
                                    <td>
                                        <?php echo e($expertise->harvest->farmer->address); ?>

                                    </td>

                                    <td class="td-actions text-right">
                                        <a href="<?php echo e(route('expertise.show', ['lab' => $expertise->laboratory->id, $expertise])); ?>" rel="tooltip" class="actionBtn">
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