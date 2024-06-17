<?php
    $indent = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $level * 4);
?>
<tr>
    <td><?php echo $indent; ?><?php echo e($department->DEP_NAME); ?></td>
    <td><?php echo e($department->DIRECTOR_EMPID); ?></td>
    <td><?php echo e($department->STATUS); ?></td>
    <td><?php echo e($department->SORT_ORDER); ?></td>
    <td><?php echo e($department->EDIT_DATE); ?></td>
    <td>
        <form action="<?php echo e(route('deleteplace', $department->DEP_ID)); ?>" method="POST" style="display:inline;">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type='submit' class='btn btn-danger' style="float: right;">Устгах</button>
        </form>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#UpdatePlaceForm"
            style="float: right;" data-id="<?php echo e($department->DEP_ID); ?>" data-name="<?php echo e($department->DEP_NAME); ?>"
            data-status="<?php echo e($department->STATUS); ?>" data-sort="<?php echo e($department->SORT_ORDER); ?>"
            data-parent="<?php echo e($department->PARENT_DEPID); ?>"
            data-director="<?php echo e($department->DIRECTOR_EMPID); ?>">Засах</button>
    </td>
</tr>

<?php if(!empty($department->children)): ?>
    <?php $__currentLoopData = $department->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $__env->make('partials.department_row', ['department' => $child, 'level' => $level + 1], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH C:\Users\pc\Documents\GitHub\dastoneTest\dastone\resources\views/partials/department_row.blade.php ENDPATH**/ ?>