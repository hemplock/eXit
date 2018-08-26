<?php $__env->startSection('breadcrumbs'); ?>
    <?php echo breadcrumbs(trans('Farmers')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="pageHolder">
        <div class="pagePanelHolder">
            <div class="pagePanelHeading">
                <div class="captionHolder">
                    <div class="icoHolder">
                        <i class="material-icons">account_circle</i>
                    </div>
                    <div class="caption">Farmers</div>
                </div>
                <div class="btnHolder">
                    <a href="<?php echo e(route('farmer.create')); ?>">
                        <i class="material-icons">add</i>
                        <span>Add New</span>
                    </a>
                </div>
            </div>
            <div class="pagePanelBody">
                <div class="tableHolder">
                    <?php if(count($farmers)>0): ?>
                        <table class="table">
                            <thead class="text-warning">
                                <tr>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Files</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $farmers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $farmer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($farmer->firstname); ?> <?php echo e($farmer->lastname); ?></td>
                                    <td><?php echo e($farmer->address); ?></td>
                                    <td>
                                        <?php if( count($farmer->files_batched) ): ?>
                                            <?php $__currentLoopData = $farmer->files_batched; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $farmer_file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <span class="fileName">
                                                    <i class="fa fa-paperclip" aria-hidden="true"></i>
                                                    <a href="#"><?php echo e($farmer_file['filename']); ?>.<?php echo e($farmer_file['extension']); ?></a>
                                                </span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </td>

                                    <td class="td-actions">
                                        <a href="<?php echo e(route('harvest.create', $farmer)); ?>" rel="tooltip" class="actionBtn" data-original-title="" title="">
                                            <i class="material-icons">art_track</i>
                                        </a>
                                        <a href="<?php echo e(route('farmer.show', $farmer)); ?>" rel="tooltip" class="actionBtn" data-original-title="" title="">
                                            <i class="material-icons">person</i>
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