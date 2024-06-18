<div class="modal fade" id="UpdatePlaceForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <div class="form-container" id="formContainer">
                <form id="registrationForm" method="POST" action="<?php echo e(route('updateplace')); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                        <input type="hidden" id="modal-dep-id" name="depId">

                        <label for="depName" class="form-check-label">Газар нэгжийн нэршил</label>
                        <input type="text" class="form-check-input" id="depName" name="depName" required>

                        <label for="status" class="form-check-label">Төлөв</label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="A">Идэвхитэй</option>
                            <option value="N">Идэвхгүй</option>
                        </select>

                        <label for="sortOrder" class="form-check-label">Эрэмбэ</label>
                        <input type="text" class="form-check-input" id="sortOrder" name="sortOrder" required>

                        <label for="parentDepId" class="form-check-label">Эцэг газар нэгж</label>
                        <select id="parentDepId" name="parentDepId" class="form-control" required>
                            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($department->DEP_ID); ?>"><?php echo e($department->DEP_NAME); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                        <label for="directorEmpId" class="form-check-label">Захирал</label>
                        <select id="directorEmpId" name="directorEmpId" class="form-control" required>
                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($employee->EMP_ID); ?>"><?php echo e($employee->EMPNAME); ?> (<?php echo e($employee->DEP_NAME); ?>

                                    - <?php echo e($employee->POS_NAME); ?>)</option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                        <button class="btn btn-primary" type="submit" name="submit">Засах</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Хаах</button>
                    </form>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\Users\hp\Desktop\dastone\resources\views/modal/updateplace.blade.php ENDPATH**/ ?>