<?php $__env->startSection('breadcrumbs'); ?>
    <?php echo breadcrumbs(trans('Laboratories')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="pageHolder">
        <div class="pagePanelHolder">
            <div class="pagePanelHeading">
                <div class="captionHolder">
                    <div class="icoHolder">
                        <i class="material-icons">assignment</i>
                    </div>
                    <div class="caption">Laboratories</div>
                </div>
                <div class="btnHolder">
                    <a href="<?php echo e(route('lab.create')); ?>">
                        <i class="material-icons">add</i>
                        <span>Add New</span>
                    </a>
                </div>
            </div>
            <div class="pagePanelBody">
                <div class="tableHolder">
                    <?php if(count($laboratories)>0): ?>
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
                            <?php $__currentLoopData = $laboratories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $laboratory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($laboratory->name); ?></td>
                                    <td><?php echo e($laboratory->address); ?></td>
                                    <td>

                                        <?php if( count($laboratory->files_batched) ): ?>
                                            <?php $__currentLoopData = $laboratory->files_batched; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $laboratory_file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <span class="fileName">
                                                    <i class="fa fa-paperclip" aria-hidden="true"></i>
                                                    <a href="#"><?php echo e($laboratory_file['filename']); ?>.<?php echo e($laboratory_file['extension']); ?></a>
                                                </span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </td>

                                    <td class="td-actions">
                                        <a href="<?php echo e(route('expertise.create', $laboratory)); ?>" rel="tooltip" class="actionBtn" data-original-title="" title="">
                                            <i class="material-icons">art_track</i>
                                        </a>
                                        <a href="<?php echo e(route('lab.show', $laboratory)); ?>" rel="tooltip" class="actionBtn" data-original-title="" title="">
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