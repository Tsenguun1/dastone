<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        $('#UpdatePlaceForm').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var depId = button.data('id');
            var depName = button.data('name');
            var status = button.data('status');
            var sortOrder = button.data('sort');
            var parentDepId = button.data('parent');
            var directorEmpId = button.data('director');

            var modal = $(this);
            modal.find('#modal-dep-id').val(depId);
            modal.find('#depName').val(depName);
            modal.find('#status').val(status);
            modal.find('#sortOrder').val(sortOrder);
            modal.find('#parentDepId').val(parentDepId);
            modal.find('#directorEmpId').val(directorEmpId);
        });
    });
</script>
<div class="modal fade" id="UpdatePlaceForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <div class="form-container" id="formContainer">
                <?php if(session('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <form id="registrationForm" method="POST" action="<?php echo e(route('updateplace')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" id="modal-dep-id" name="depId">

                    <label for="depName" class="form-check-label">Газар нэгжийн нэршил</label>
                    <input type="text" class="form-check-input" id="depName" name="depName" required>

                    <label for="status" class="form-check-label">Төлөв</label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="A">Идэвхитэй</option>
                        <option value="N">Идэвхгүй</option>
                    </select>

                    <label for="sortOrder" class="form-check-label">Эрэмбэ</label>
                    <input type="text" class="form-check-input" id="sortOrder" name="sortOrder">

                    <label for="parentDepId" class="form-check-label">Эцэг газар нэгж</label>
                    <select id="parentDepId" name="parentDepId" class="form-control" required>
                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($department->DEP_ID); ?>"><?php echo e($department->DEP_NAME); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    <label for="directorEmpId" class="form-check-label">Захирал</label>
                    <select id="directorEmpId" name="directorEmpId" class="form-control" required>
                        <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($employee->EMP_ID); ?>"><?php echo e($employee->EMPNAME); ?> (<?php echo e($employee->DEP_NAME); ?> -
                                <?php echo e($employee->POS_NAME); ?>)
                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    <button class="btn btn-primary" type="submit" name="submit">Засах</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Хаах</button>
                </form>
            </div>
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div><!--end modal-->


<div class="modal fade" id="AddPlaceForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <div class="form-container" id="formContainer">
                <?php if(session('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <form id="registrationForm" method="POST" action="<?php echo e(route('addform')); ?>">
                    <?php echo csrf_field(); ?>
                    <label for="depName" class="form-check-label">Газар нэгжийн нэршил</label>
                    <input type="text" class="form-check-input" id="depName" name="depName" required>

                    <label for="status" class="form-check-label">Төлөв</label>
                    <select id="status" name="status" required>
                        <option value="">[Сонгоно уу]</option>
                        <option value="A">Идэвхитэй</option>
                        <option value="N">Идэвхгүй</option>
                    </select>

                    <label for="sortOrder" class="form-check-label">Эрэмбэ</label>
                    <input type="text" class="form-check-input" id="sortOrder" name="sortOrder" required>

                    <label for="parentDepId" class="form-check-label">Эцэг газар нэгж</label>
                    <select id="parentDepId" name="parentDepId" required>
                        <option value="">[Сонгоно уу]</option>
                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($department->DEP_ID); ?>"><?php echo e($department->DEP_NAME); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    <label for="directorEmpId" class="form-check-label">Захирал</label>
                    <select id="directorEmpId" name="directorEmpId" required>
                        <option value="">[Сонгоно уу]</option>
                        <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($employee->EMP_ID); ?>"><?php echo e($employee->EMPNAME); ?> (<?php echo e($employee->DEP_NAME); ?>-<?php echo e($employee->POS_NAME); ?>)
                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <button class="btn btn-primary" type="submit" name="submit">Хадгалах</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Хаах</button>
                </form>
            </div>
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div><!--end modal--><?php /**PATH C:\Users\hp\Desktop\dastone\resources\views/modal/addplace.blade.php ENDPATH**/ ?>