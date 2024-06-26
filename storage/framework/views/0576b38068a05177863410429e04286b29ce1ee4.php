<div class="form-container" id="formContainer">
    <div class="container mt-5">
        <form id="registrationForm" action="<?php echo e(route('updateemployee', $employee->EMP_ID)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <input type="hidden" name="EMP_ID" value="<?php echo e($employee->EMP_ID); ?>">

            <?php if($employee->PICTURE_LINK): ?>
                <img src="<?php echo e(asset($employee->PICTURE_LINK)); ?>" alt="Employee Picture" class="img-thumbnail mt-2"
                    style=" width:100px; height:100px; border-radius:50%; margin:1px; margin-top : -50px;">
            <?php endif; ?>
            <div class="row">
                <div class="col-md-6">
                    <label for="REGISTER" class="form-check-label">Регистр</label>
                    <input type="text" class="form-control" id="REGISTER" name="REGISTER"
                        value="<?php echo e($employee->REGISTER); ?>" required>

                    <label for="FIRSTNAME" class="form-check-label">Эцэг/эхийн нэр</label>
                    <input type="text" class="form-control" id="FIRSTNAME" name="FIRSTNAME"
                        value="<?php echo e($employee->FIRSTNAME); ?>" required>

                    <label for="LASTNAME" class="form-check-label">Өөрийн нэр</label>
                    <input type="text" class="form-control" id="LASTNAME" name="LASTNAME"
                        value="<?php echo e($employee->LASTNAME); ?>" required>

                    <label for="DEP_ID" class="form-check-label">Газар нэгж</label>
                    <select id="DEP_ID" name="DEP_ID" class="form-control" required>
                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($department->DEP_ID); ?>" <?php echo e($department->DEP_ID == $employee->DEP_ID ? 'selected' : ''); ?>><?php echo e($department->DEP_NAME); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <label for="POS_ID" class="form-check-label">Албан тушаал</label>
                    <select id="POS_ID" name="POS_ID" class="form-control" required>
                        <?php $__currentLoopData = $positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $position): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($position->POS_ID); ?>" <?php echo e($position->POS_ID == $employee->POS_ID ? 'selected' : ''); ?>>
                                <?php echo e($position->POS_NAME); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <label for="EMAIL" class="form-check-label">Цахим шуудан</label>
                    <input type="email" class="form-control" id="EMAIL" name="EMAIL" value="<?php echo e($employee->EMAIL); ?>"
                        required>

                    <div class="form-group">
                        <label for="WORK_DATE" class="form-check-label">Ажилд орсон огноо</label>
                        <input type="date" class="form-control" id="WORK_DATE" name="WORK_DATE"
                            value="<?php echo e(old('WORK_DATE', date('Y-m-d', strtotime($employee->WORK_DATE)))); ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="STATUS" class="form-check-label">Төлөв</label>
                    <select id="STATUS" name="STATUS" class="form-control" required>
                        <option value="A" <?php echo e($employee->STATUS == 'A' ? 'selected' : ''); ?>>Идэвхитэй</option>
                        <option value="N" <?php echo e($employee->STATUS == 'N' ? 'selected' : ''); ?>>Идэвхгүй</option>
                    </select>

                    <label for="HANDPHONE" class="form-check-label">Гар утас</label>
                    <input type="text" class="form-control" id="HANDPHONE" name="HANDPHONE"
                        value="<?php echo e($employee->HANDPHONE); ?>" required>
                    <label for="HOMEPHONE" class="form-check-label">Гэрийн утас</label>
                    <input type="text" class="form-control" id="HOMEPHONE" name="HOMEPHONE"
                        value="<?php echo e($employee->HOMEPHONE); ?>">

                    <label for="WORKPHONE" class="form-check-label">Ажлын утас</label>
                    <input type="text" class="form-control" id="WORKPHONE" name="WORKPHONE"
                        value="<?php echo e($employee->WORKPHONE); ?>">

                    <label for="SEX" class="form-check-label">Хүйс</label>
                    <select id="SEX" name="SEX" class="form-control" required>
                        <option value="M" <?php echo e($employee->SEX == 'M' ? 'selected' : ''); ?>>Эрэгтэй</option>
                        <option value="F" <?php echo e($employee->SEX == 'F' ? 'selected' : ''); ?>>Эмэгтэй</option>
                    </select>
                    <label for="PICTURE_LINK" class="form-check-label">Зураг</label>
                    <input type="file" class="form-control" id="PICTURE_LINK" name="PICTURE_LINK">
                    <div class="form-group">
                        <label for="BIRTHDATE" class="form-check-label">Төрсөн огноо</label>
                        <input type="date" class="form-control" id="BIRTHDATE" name="BIRTHDATE"
                            value="<?php echo e(old('BIRTHDATE', date('Y-m-d', strtotime($employee->BIRTHDATE)))); ?>" required>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <button type="submit" class="btn btn-primary mt-3" id="saveEmployeeChanges">Засах</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Хаах</button>
            </div>
        </form>
    </div>
</div><?php /**PATH C:\Users\pc\Documents\GitHub\dastone\resources\views/partials/editemployeeform.blade.php ENDPATH**/ ?>