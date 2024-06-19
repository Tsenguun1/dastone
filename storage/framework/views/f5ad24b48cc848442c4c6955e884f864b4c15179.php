<div class="form-container" id="formContainer">
    <form id="registrationForm" action="<?php echo e(route('updateplace', $place->DEP_ID)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <label for="depName" class="form-check-label">Газар нэгжийн нэршил</label>
        <input type="text" class="form-control" id="depName" name="depName" value="<?php echo e($place->DEP_NAME); ?>" required>

        <label for="status" class="form-check-label">Төлөв</label>
        <select id="status" name="status" class="form-control" required>
            <option value="A" <?php echo e($place->STATUS == 'A' ? 'selected' : ''); ?>>Идэвхитэй</option>
            <option value="N" <?php echo e($place->STATUS == 'N' ? 'selected' : ''); ?>>Идэвхгүй</option>
        </select>

        <label for="sortOrder" class="form-check-label">Эрэмбэ</label>
        <input type="number" class="form-check-input" id="sortOrder" name="sortOrder" value="<?php echo e($place->SORT_ORDER); ?>"
            required>
        <label for="parentDepId" class="form-check-label">Эцэг газар нэгж</label>
        <select id="parentDepId" name="parentDepId" class="form-control" required>
            <option value="">[Сонгоно уу]</option>
            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($department->DEP_ID); ?>" <?php echo e(old('parentDepId', $place->PARENT_DEPID) == $department->DEP_ID ? 'selected' : ''); ?>>
                    <?php echo e($department->DEP_NAME); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <label for="directorEmpId" class="form-check-label">Захирал</label>
        <select id="directorEmpId" name="directorEmpId" class="form-control" required>
            <option value="">[Сонгоно уу]</option>
            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($employee->EMP_ID); ?>" <?php echo e(old('directorEmpId', $place->DIRECTOR_EMPID) == $employee->EMP_ID ? 'selected' : ''); ?>>
                    <?php echo e($employee->EMPNAME); ?> (<?php echo e($employee->DEP_NAME); ?>-<?php echo e($employee->POS_NAME); ?>)
                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <button type="submit" class="btn btn-primary">Хадгалах</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Хаах</button>
    </form>
</div><?php /**PATH C:\Users\pc\Documents\GitHub\dastone\resources\views/partials/editplaceform.blade.php ENDPATH**/ ?>