
<?php $__env->startSection('content'); ?>
<div class="page-wrapper">
    <div class="topbar">
        <nav class="navbar-custom">
            <ul class="list-unstyled topbar-nav mb-0">
                <h4 class="page-title" style="margin: 10px;">Ажилтны бүртгэл</h4>
                <button type="button" class="btn btn-sm btn-soft-primary" style="margin: 10px; margin-top: 30px;"
                    data-bs-toggle="modal" data-bs-target="#AddEmployeeForm">+ Шинээр бүртгэх</button>

                <div class='card-body'>
                    <div class='table-rep-plugin'>
                        <div class='table-responsive mb-0' data-pattern='priority-columns'>
                            <table id='tech-companies-1' class='table table-striped mb-0'>
                                <thead>
                                    <tr>
                                        <th>Зураг</th>
                                        <th>Эцэг/эхийн нэр</th>
                                        <th>Өөрийн нэр</th>
                                        <th>Газар нэгж</th>
                                        <th>Албан тушаал</th>
                                        <th>Регистр</th>
                                        <th>Хүйс</th>
                                        <th>Цахим шуудан</th>
                                        <th>Төрсөн огноо</th>
                                        <th>Гар утас</th>
                                        <th>Ажлын утас</th>
                                        <th>Төлөв</th>
                                        <th>Үйлдэл</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><img src="<?php echo e($employee->PICTURE_LINK); ?>" style=" border-radius: 50%; width: 50px; height: 50px; object-fit: cover;" alt="Employee Picture" width="50"></td>
                                            <td><?php echo e($employee->FIRSTNAME); ?></td>
                                            <td><?php echo e($employee->LASTNAME); ?></td>
                                            <td><?php echo e($employee->DEP_ID); ?></td>
                                            <td><?php echo e($employee->POS_ID); ?></td>
                                            <td><?php echo e($employee->REGISTER); ?></td>
                                            <td><?php echo e($employee->SEX); ?></td>
                                            <td><?php echo e($employee->EMAIL); ?></td>
                                            <td><?php echo e($employee->BIRTHDATE); ?></td>
                                            <td><?php echo e($employee->HANDPHONE); ?></td>
                                            <td><?php echo e($employee->WORKPHONE); ?></td>
                                            <td><?php echo e($employee->STATUS); ?></td>
                                            <td>
                                                <button type='button' class='btn btn-success' data-bs-toggle='modal'
                                                    data-bs-target='#UpdateEmployeeForm'
                                                    data-photo='<?php echo e($employee->PICTURE_LINK); ?>'
                                                    data-state='<?php echo e($employee->STATUS); ?>' data-id='<?php echo e($employee->EMP_ID); ?>'
                                                    data-homephone='<?php echo e($employee->HOMEPHONE); ?>'
                                                    data-firstname='<?php echo e($employee->FIRSTNAME); ?>'
                                                    data-lastname='<?php echo e($employee->LASTNAME); ?>'
                                                    data-depid='<?php echo e($employee->DEP_ID); ?>'
                                                    data-posid='<?php echo e($employee->POS_ID); ?>'
                                                    data-register='<?php echo e($employee->REGISTER); ?>'
                                                    data-sex='<?php echo e($employee->SEX); ?>' data-email='<?php echo e($employee->EMAIL); ?>'
                                                    data-birthdate='<?php echo e($employee->BIRTHDATE); ?>'
                                                    data-handphone='<?php echo e($employee->HANDPHONE); ?>'
                                                    data-workphone='<?php echo e($employee->WORKPHONE); ?>'
                                                    data-status='<?php echo e($employee->STATUS); ?>'
                                                    data-workdate='<?php echo e($employee->WORK_DATE); ?>'>Засах</button>
                                                <form action="<?php echo e(route('deleteemployee', ['id' => $employee->EMP_ID])); ?>"
                                                    method="POST" style="display:inline;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-danger">Устгах</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </ul>
        </nav>
    </div>
</div>

<?php echo $__env->make('modal.addemployee', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const updateEmployeeFormModal = document.getElementById('UpdateEmployeeForm');
        updateEmployeeFormModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;

            const empId = button.getAttribute('data-id');
            const firstName = button.getAttribute('data-firstname');
            const lastName = button.getAttribute('data-lastname');
            const depId = button.getAttribute('data-depid');
            const posId = button.getAttribute('data-posid');
            const register = button.getAttribute('data-register');
            const sex = button.getAttribute('data-sex');
            const email = button.getAttribute('data-email');
            const birthDate = button.getAttribute('data-birthdate');
            const handPhone = button.getAttribute('data-handphone');
            const workPhone = button.getAttribute('data-workphone');
            const status = button.getAttribute('data-status');

            document.getElementById('modal-emp-id').value = empId;
            document.getElementById('first_name').value = firstName;
            document.getElementById('last_name').value = lastName;
            document.getElementById('place').value = depId;
            document.getElementById('position').value = posId;
            document.getElementById('reg_number').value = register;
            document.getElementById('gender').value = sex;
            document.getElementById('email').value = email;
            document.getElementById('birth_date').value = birthDate;
            document.getElementById('phone_number').value = handPhone;
            document.getElementById('work_number').value = workPhone;
            document.getElementById('state').value = status;
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pc\Documents\GitHub\dastoneTest\dastone\resources\views/viewemployee.blade.php ENDPATH**/ ?>