<div class="addNewItemHolder" id="wizardProfile">
    <form action="<?php echo e($formAction); ?>" method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <?php echo method_field($formMethod); ?>


        <div class="titleHolder">
            <h3 class="mainTitle"><?php echo e($formTitle); ?></h3>
            <h5 class="subTitle"><?php echo e($formTitleSmall); ?></h5>
        </div>
        <ul class="stepsNameHolder">
            <li class="active" aria-expanded="true"><a href="#step1" data-toggle="tab">Account</a></li>
            <li><a href="#step2" data-toggle="tab">Personal</a></li>
            <li><a href="#step3" data-toggle="tab">Documents</a></li>
        </ul>
        <div class="stepsContentHolder tab-content">
            <div class="stepsContent tab-pane active" id="step1">
                <div class="heading">Let's start with the basic information (with validation)</div>
                <?php echo $__env->make('component.wizard.input',[
                    'iIcon'                 => '<i class="material-icons">face</i>',
                    'iPlaceholder'          => 'Tester first name',
                    'iPlaceholderSmall'     => '(required)',
                    'iName'                 => "tester[firstname]",
                    'iValue'                => array_get($tester, 'firstname'),
                    'iId'                   => "tester-first-name",
                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <?php echo $__env->make('component.wizard.input',[
                    'iIcon'                 => '<i class="material-icons">account_circle</i>',
                    'iPlaceholder'          => 'Tester last name',
                    'iPlaceholderSmall'     => '(required)',
                    'iName'                 => "tester[lastname]",
                    'iValue'                => array_get($tester, 'lastname'),
                    'iId'                   => "tester-second-name",
                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <?php echo $__env->make('component.wizard.input',[
                    'iIcon'                 => '<i class="material-icons">account_circle</i>',
                    'iPlaceholder'          => 'Tester date of birth',
                    'iPlaceholderSmall'     => '(required)',
                    'iName'                 => "tester[date_of_birth]",
                    'iValue'                => array_get($tester, 'date_of_birth'),
                    'iId'                   => "tester-date_of_birth",
                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <?php echo $__env->make('component.wizard.input',[
                    'iIcon'                 => '<i class="material-icons">email</i>',
                    'iPlaceholder'          => 'Email',
                    'iType'                 => 'email',
                    'iPlaceholderSmall'     => '(required)',
                    'iName'                 => "tester[email]",
                    'iValue'                => array_get($tester, 'email'),
                    'iId'                   => "tester-email",
                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <?php echo $__env->make('component.wizard.input',[
                        'iIcon'                 => '<i class="material-icons">location_on</i>',
                        'iPlaceholder'          => 'Tester location',
                        'iPlaceholderSmall'     => '(required)',
                        'iName'                 => "tester[address]",
                        'iValue'                => array_get($tester, 'address'),
                        'iId'                   => "tester-address-autocomplete",
                        'iClass'                => "location-address",
                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

 ])

                <?php echo $__env->make('component.wizard.input',[
                        'iIcon'                 => '<i class="material-icons">location_on</i>',
                        'iPlaceholder'          => 'eth_address',
                        'iPlaceholderSmall'     => '',
                        'iName'                 => "tester[eth_address]",
                        'iValue'                => array_get($tester, 'eth_address'),
                        'iId'                   => "tester-eth_address-autocomplete",
                        'iClass'                => "location-address",
                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>







                <div class="formGroup ">
                    <div class="iconHolder">
                        <i class="material-icons">language</i>
                    </div>
                    <div class="mapHolder">
                        <div class="likeMap" id="location-map-container"></div>
                    </div>

                    <input type="hidden" name="googleMapAPI[placeID]" id="address-placeID"
                           value="<?php echo e(array_get($tester, 'gm_place_id')); ?>">
                    <input type="hidden" name="googleMapAPI[lon]" id="address-lon"
                           value="<?php echo e(array_get($tester, 'gm_lon')); ?>">
                    <input type="hidden" name="googleMapAPI[lat]" id="address-lat"
                           value="<?php echo e(array_get($tester, 'gm_lat')); ?>">


                    <?php echo $__env->make('component.google-app.google-places.autocomplete',['idAutocomplete'=>'tester-address-autocomplete', 'idMap' =>'location-map-container', 'idLon'=>'address-lon','idLat'=>'address-lat', 'idPlaceID'=>'address-placeID'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('component.google-app.google-places', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
            </div>


            <div class="stepsContent tab-pane" id="step2">
                <div class="heading">Any information, that you wish to set....</div>

                <div class="additionalInfoInputs" data-section="props">
                    <?php echo $__env->make('component.wizard.prop-sample', ['asSample'=>true, 'mName'=>'tester_props'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <?php $__currentLoopData = array_get($tester, 'props_batched',[]); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('component.wizard.prop-sample', [ 'prop' => $prop, 'mName'=>'tester_props' ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="btnInnerHolder">
                    <a href="#" class="btnGrad addRecord">
                        <i class="fa fa-plus"></i>
                        Add
                    </a>
                </div>
            </div>
            <div class="stepsContent tab-pane" id="step3">
                <div class="heading">You can attach files and documents here.</div>
                <div class="btnInnerHolder">
                    <a href="#" class="btnGrad addFileSection">
                        <i class="fa fa-paperclip"></i>
                        Attach
                    </a>
                </div>
                <div class="fileCardHolder">
                    <?php echo $__env->make('component.wizard.attach-file-sample', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php $__currentLoopData = array_get($tester, 'files_batched',[]); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('component.wizard.existing-file', ['file' => $file], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <div class="btnHolder">
            <div class="leftPart">
                <a href="#" class="btnGrey btn-previous">Back</a>
            </div>
            <div class="rightPart">
                <a href="#" class="btnGrad btn-next">Next</a>
                <button type="submit" class="btnGrad btn-finish" name="finish">Finish</button>
            </div>
        </div>
    </form>

    
    

    <?php echo $__env->make('tester._form.js_validator', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
