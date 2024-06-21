<!-- resources/views/partials/employee_row.blade.php -->
<tr>
    <td><img src="<?php echo e($employee->PICTURE_LINK); ?>" style="border-radius: 50%; width: 50px; height: 50px; object-fit: cover;" alt="Employee Picture" width="50"></td>
    <td><?php echo e($employee->FIRSTNAME); ?></td>
    <td><?php echo e($employee->LASTNAME); ?></td>
    <td><?php echo e($employee->DEP_NAME); ?></td> <!-- Displaying Department Name -->
    <td><?php echo e($employee->POS_NAME); ?></td> <!-- Displaying Position Name -->
    <td><?php echo e($employee->REGISTER); ?></td>
    <td><?php echo e($employee->SEX); ?></td>
    <td><?php echo e($employee->EMAIL); ?></td>
    <td><?php echo e($employee->BIRTHDATE); ?></td>
    <td><?php echo e($employee->HANDPHONE); ?></td>
    <td><?php echo e($employee->WORKPHONE); ?></td>
    <td>
        <?php if($employee->STATUS == 'A'): ?>
            Идэвхитэй
        <?php elseif($employee->STATUS == 'N'): ?>
            Идэвхгүй
        <?php else: ?>
            Unknown Status
        <?php endif; ?>
    </td>
    <td>
        <button type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#UpdateEmployeeForm'
            data-photo='<?php echo e($employee->PICTURE_LINK); ?>' data-state='<?php echo e($employee->STATUS); ?>' data-id='<?php echo e($employee->EMP_ID); ?>'
            data-homephone='<?php echo e($employee->HOMEPHONE); ?>' data-firstname='<?php echo e($employee->FIRSTNAME); ?>'
            data-lastname='<?php echo e($employee->LASTNAME); ?>' data-depid='<?php echo e($employee->DEP_ID); ?>'
            data-posid='<?php echo e($employee->POS_ID); ?>' data-register='<?php echo e($employee->REGISTER); ?>'
            data-sex='<?php echo e($employee->SEX); ?>' data-email='<?php echo e($employee->EMAIL); ?>'
            data-birthdate='<?php echo e($employee->BIRTHDATE); ?>' data-handphone='<?php echo e($employee->HANDPHONE); ?>'
            data-workphone='<?php echo e($employee->WORKPHONE); ?>' data-status='<?php echo e($employee->STATUS); ?>'
            data-workdate='<?php echo e($employee->WORK_DATE); ?>'>Засах</button>
            
        <form action="<?php echo e(route('deleteemployee', ['id' => $employee->EMP_ID])); ?>" method="POST" style="display:inline;">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit" class="btn btn-danger">Устгах</button>
        </form>
    </td>
</tr>
<?php /**PATH C:\Users\pc\Documents\GitHub\dastone\resources\views/partials/employee_row.blade.php ENDPATH**/ ?>